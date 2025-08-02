<?php

namespace Controllers\Maintenance\Admin\FuncionesRoles;

use Controllers\PrivateController;
use Dao\Admin\FuncionesRoles\FuncionesRoles as FuncionesRolesDAO;
use Views\Renderer;
use Utilities\Site;
use Utilities\Validators;

const LIST_URL = "index.php?page=Maintenance-Admin-FuncionesRoles-FuncionesRoles";

class FuncionRol extends PrivateController
{
    private array $viewData;
    private array $modes;

    public function __construct()
    {
        $this->viewData = [
            "mode" => "",
            "rolescod" => 0,
            "fnrolest" => "",
            "fnexp" => "",
            "modeDsc" => "",
            "errors" => [],
            "cancelLabel" => "Cancelar",
            "showConfirm" => true,
            "readonly" => ""
        ];
        $this->modes = [
            "INS" => "Nueva Relación Función-Rol",
            "UPD" => "Actualizando relación %s",
            "DEL" => "Eliminando relación %s",
            "DSP" => "Detalle de relación %s"
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
        Renderer::render("funcionrol", $this->viewData);
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
            if (!isset($_GET["rolescod"])) {
                $this->throwError("Código de relación inválido");
            }
            $this->viewData["rolescod"] = intval($_GET["rolescod"]);
        }
    }

    private function getDataFromDB()
    {
        $funcionRol = FuncionesRolesDAO::getFuncionesRolesById($this->viewData["rolescod"]);
        if (!$funcionRol) {
            $this->throwError("Relación no encontrada");
        }
        $this->viewData = array_merge($this->viewData, $funcionRol);
    }

    private function getBodyData()
    {
        $expected = ["rolescod", "fnrolest", "fnexp", "xsrtoken"];
        foreach ($expected as $key) {
            if (!isset($_POST[$key])) {
                $this->throwError("Parámetro faltante: $key");
            }
        }

        if (intval($_POST["rolescod"]) !== $this->viewData["rolescod"]) {
            $this->throwError("ID inconsistente");
        }

        if ($_POST["xsrtoken"] !== $_SESSION[$this->name . "-xsrtoken"]) {
            $this->throwError("Token inválido");
        }

        $this->viewData["fnrolest"] = $_POST["fnrolest"];
        $this->viewData["fnexp"] = $_POST["fnexp"];
    }

    private function validateData(): bool
    {
        if (Validators::IsEmpty($this->viewData["fnrolest"])) {
            $this->innerError("fnrolest", "El estado es obligatorio");
        }

        if (Validators::IsEmpty($this->viewData["fnexp"])) {
            $this->innerError("fnexp", "La fecha de expiración es obligatoria");
        }

        return count($this->viewData["errors"]) === 0;
    }

    private function processData()
    {
        $mode = $this->viewData["mode"];
        switch ($mode) {
            case "INS":
                if (FuncionesRolesDAO::newfuncionesroles(
                    $this->viewData["fnrolest"],
                    $this->viewData["fnexp"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Relación creada con éxito");
                }
                break;

            case "UPD":
                if (FuncionesRolesDAO::updatefuncionesroles(
                    $this->viewData["rolescod"],
                    $this->viewData["fnrolest"],
                    $this->viewData["fnexp"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Relación actualizada con éxito");
                }
                break;

            case "DEL":
                if (FuncionesRolesDAO::deletefuncionesroles($this->viewData["rolescod"]) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Relación eliminada con éxito");
                }
                break;
        }
        $this->innerError("global", "Ocurrió un error al procesar la solicitud");
    }

    private function prepareViewData()
    {
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["rolescod"]
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
