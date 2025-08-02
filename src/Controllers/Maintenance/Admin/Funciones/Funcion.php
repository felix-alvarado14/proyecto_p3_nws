<?php

namespace Controllers\Maintenance\Admin\Funciones;

use Controllers\PrivateController;
use Dao\Admin\Funciones\Funciones as FuncionesDAO;
use Views\Renderer;
use Utilities\Site;
use Utilities\Validators;

const LIST_URL = "index.php?page=Maintenance-Admin-Funciones-Funciones";

class Funcion extends PrivateController
{
    private array $viewData;
    private array $modes;

    public function __construct()
    {
        $this->viewData = [
            "mode" => "",
            "fncod" => 0,
            "fndsc" => "",
            "fnest" => "",
            "fntyp" => "",
            "modeDsc" => "",
            "errors" => [],
            "cancelLabel" => "Cancelar",
            "showConfirm" => true,
            "readonly" => ""
        ];
        $this->modes = [
            "INS" => "Nueva Función",
            "UPD" => "Actualizando %s",
            "DEL" => "Eliminando %s",
            "DSP" => "Detalle de %s"
        ];
    }

    public function run(): void
    {
        $this->getQueryParamsData();
        if ($this->viewData["mode"] !== "INS") {
            $this->getDataFromDB();
        }

        if ($this->isPostBack()) {
            $this->getBodyData();
            if ($this->validateData()) {
                $this->processData();
            }
        }

        $this->prepareViewData();
        Renderer::render("funcion", $this->viewData);
    }

    private function throwError(string $message, string $log = "")
    {
        if (!empty($log)) error_log($log);
        Site::redirectToWithMsg(LIST_URL, $message);
    }

    private function innerError(string $scope, string $message)
    {
        $this->viewData["errors"][$scope][] = $message;
    }

    private function getQueryParamsData()
    {
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            $this->throwError("Modo inválido");
        }

        $this->viewData["mode"] = $_GET["mode"];

        if ($_GET["mode"] !== "INS") {
            if (!isset($_GET["fncod"])) {
                $this->throwError("Código de función inválido");
            }
            $this->viewData["fncod"] = intval($_GET["fncod"]);
        }
    }

    private function getDataFromDB()
    {
        $funcion = FuncionesDAO::getFuncionesById($this->viewData["fncod"]);
        if (!$funcion) {
            $this->throwError("Función no encontrada");
        }
        $this->viewData = array_merge($this->viewData, $funcion);
    }

    private function getBodyData()
    {
        $expected = ["fncod", "fndsc", "fnest", "fntyp", "xsrtoken"];
        foreach ($expected as $key) {
            if (!isset($_POST[$key])) {
                $this->throwError("Parámetro faltante: $key");
            }
        }

        if (intval($_POST["fncod"]) !== $this->viewData["fncod"]) {
            $this->throwError("ID inconsistente");
        }

        if ($_POST["xsrtoken"] !== $_SESSION[$this->name . "-xsrtoken"]) {
            $this->throwError("Token inválido");
        }

        $this->viewData["fndsc"] = $_POST["fndsc"];
        $this->viewData["fnest"] = $_POST["fnest"];
        $this->viewData["fntyp"] = $_POST["fntyp"];
    }

    private function validateData(): bool
    {
        if (Validators::IsEmpty($this->viewData["fndsc"])) {
            $this->innerError("fndsc", "La descripción es obligatoria");
        }
        if (Validators::IsEmpty($this->viewData["fnest"])) {
            $this->innerError("fnest", "El estado es obligatorio");
        }
        if (Validators::IsEmpty($this->viewData["fntyp"])) {
            $this->innerError("fntyp", "El tipo es obligatorio");
        }

        return count($this->viewData["errors"]) === 0;
    }

    private function processData()
    {
        $mode = $this->viewData["mode"];
        switch ($mode) {
            case "INS":
                if (FuncionesDAO::newfuncion(
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Función creada con éxito");
                }
                break;

            case "UPD":
                if (FuncionesDAO::updatefuncion(
                    $this->viewData["fncod"],
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Función actualizada con éxito");
                }
                break;

            case "DEL":
                if (FuncionesDAO::deletefuncion($this->viewData["fncod"]) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Función eliminada con éxito");
                }
                break;
        }
        $this->innerError("global", "Ocurrió un error al procesar la solicitud");
    }

    private function prepareViewData()
    {
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["fndsc"]
        );

        foreach ($this->viewData["errors"] as $scope => $err) {
            $this->viewData["errors_" . $scope] = $err;
        }

        if ($this->viewData["mode"] === "DSP") {
            $this->viewData["cancelLabel"] = "Regresar";
            $this->viewData["showConfirm"] = false;
        }

        if (in_array($this->viewData["mode"], ["DEL", "DSP"])) {
            $this->viewData["readonly"] = "readonly";
        }

        $this->viewData["timestamp"] = time();
        $this->viewData["xsrtoken"] = hash("sha256", json_encode($this->viewData));
        $_SESSION[$this->name . "-xsrtoken"] = $this->viewData["xsrtoken"];
    }
}
