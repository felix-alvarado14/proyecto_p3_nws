<?php

namespace Controllers\Maintenance\Roles;

use Controllers\PrivateController;
use Dao\Admin\Roles\Roles as RolesDAO;
use Views\Renderer;
use Utilities\Site;
use Utilities\Validators;

const LIST_URL = "index.php?page=Maintenance-Admin-Roles-Roles";

class Rol extends PrivateController
{
    private array $viewData;
    private array $modes;

    public function __construct()
    {
        $this->viewData = [
            "mode" => "",
            "rolescod" => "",
            "rolesdsc" => "",
            "rolesest" => "",
            "modeDsc" => "",
            "errors" => [],
            "cancelLabel" => "Cancelar",
            "showConfirm" => true,
            "readonly" => ""
        ];

        $this->modes = [
            "INS" => "Nuevo Rol",
            "UPD" => "Editar Rol: %s",
            "DEL" => "Eliminar Rol: %s",
            "DSP" => "Detalle del Rol: %s"
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
        Renderer::render("rol", $this->viewData);
    }

    private function throwError(string $message, string $logMessage = "")
    {
        if (!empty($logMessage)) {
            error_log(sprintf("%s - %s", $this->name, $logMessage));
        }
        Site::redirectToWithMsg(LIST_URL, $message);
    }

    private function innerError(string $scope, string $message)
    {
        $this->viewData["errors"][$scope][] = $message;
    }

    private function getQueryParamsData()
    {
        if (!isset($_GET["mode"])) {
            $this->throwError("Parámetro 'mode' faltante");
        }

        $this->viewData["mode"] = $_GET["mode"];

        if (!isset($this->modes[$this->viewData["mode"]])) {
            $this->throwError("Modo no válido: " . $this->viewData["mode"]);
        }

        if ($this->viewData["mode"] !== "INS") {
            if (!isset($_GET["rolescod"]) || trim($_GET["rolescod"]) === "") {
                $this->throwError("ID de rol inválido o faltante");
            }
            $this->viewData["rolescod"] = trim($_GET["rolescod"]);
        }
    }

    private function getDataFromDB()
    {
        $rol = RolesDAO::getRolesById($this->viewData["rolescod"]);

        if (!$rol) {
            $this->throwError("Rol no encontrado", "ID no existe: " . $this->viewData["rolescod"]);
        }

        foreach ($rol as $key => $value) {
            if (array_key_exists($key, $this->viewData)) {
                $this->viewData[$key] = $value;
            }
        }
    }

    

    private function getBodyData()
    {
        $fields = ["rolescod", "rolesdsc", "rolesest"];

        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                $this->throwError("Falta el campo: $field");
            }
            $this->viewData[$field] = trim($_POST[$field]);
        }

        if (!isset($_POST["xsrtoken"]) || $_POST["xsrtoken"] !== $_SESSION[$this->name . "-xsrtoken"]) {
            $this->throwError("Token XSR inválido");
        }

        if ($this->viewData["mode"] !== "INS" &&
            $this->viewData["rolescod"] !== $_GET["rolescod"]) {
            $this->throwError("ID del rol inconsistente");
        }
    }

    private function validateData(): bool
    {
        if (Validators::IsEmpty($this->viewData["rolesdsc"])) {
            $this->innerError("rolesdsc", "La descripción del rol es requerida.");
        }

        if (!in_array($this->viewData["rolesest"], ["ACT", "INA"])) {
            $this->innerError("rolesest", "Estado inválido.");
        }

        return count($this->viewData["errors"]) === 0;
    }

    private function processData()
    {
        switch ($this->viewData["mode"]) {
            case "INS":
                $result = RolesDAO::newrol(
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Rol creado exitosamente");
                } else {
                    $this->innerError("global", "No se pudo crear el rol.");
                }
                break;
            case "UPD":
                $result = RolesDAO::updaterol(
                    $this->viewData["rolescod"],
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Rol actualizado exitosamente");
                } else {
                    $this->innerError("global", "No se pudo actualizar el rol.");
                }
                break;
            case "DEL":
                $result = RolesDAO::deleterol($this->viewData["rolescod"]);
                if ($result > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Rol eliminado exitosamente");
                } else {
                    $this->innerError("global", "No se pudo eliminar el rol.");
                }
                break;
        }
    }

    private function prepareViewData()
    {
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["rolesdsc"]
        );

        foreach ($this->viewData["errors"] as $scope => $msgs) {
            $this->viewData["errors_" . $scope] = $msgs;
        }

        if ($this->viewData["mode"] === "DSP") {
            $this->viewData["cancelLabel"] = "Regresar";
            $this->viewData["showConfirm"] = false;
        }

        if (in_array($this->viewData["mode"], ["DSP", "DEL"])) {
            $this->viewData["readonly"] = "readonly";
        }

        $this->viewData["timestamp"] = time();
        $this->viewData["xsrtoken"] = hash("sha256", json_encode($this->viewData));
        $_SESSION[$this->name . "-xsrtoken"] = $this->viewData["xsrtoken"];
    }
}