<?php

namespace Controllers\Maintenance\Usuarios;

use Controllers\PrivateController;
use Dao\Usuarios\Usuarios as UsuariosDAO;
use Views\Renderer;
use Utilities\Site;
use Utilities\Validators;

const LIST_URL = "index.php?page=Maintenance-Usuarios-Usuarios";

class Usuario extends PrivateController
{
    private array $viewData;
    private array $modes;

    public function __construct()
    {
        $this->viewData = [
            "mode" => "",
            "usercod" => 0,
            "username" => "",
            "useremail" => "",
            "userpswd" => "",
            "userfching" => "",
            "userpswdest" => "",
            "userpswdexp" => "",
            "userest" => "",
            "useractcod" => "",
            "userpswdchg" => "",
            "usertipo" => "",
            "modeDsc" => "",
            "errors" => [],
            "cancelLabel" => "Cancel",
            "showConfirm" => true,
            "readonly" => ""
        ];

        $this->modes = [
            "INS" => "Nuevo Usuario",
            "UPD" => "Editar Usuario: %s",
            "DEL" => "Eliminar Usuario: %s",
            "DSP" => "Detalle del Usuario: %s"
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
        Renderer::render("usuario", $this->viewData);
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
            if (!isset($_GET["usercod"]) || !is_numeric($_GET["usercod"])) {
                $this->throwError("ID de usuario inválido o faltante");
            }
            $this->viewData["usercod"] = intval($_GET["usercod"]);
        }
    }

    private function getDataFromDB()
    {
        $usuario = UsuariosDAO::getUsuariosById($this->viewData["usercod"]);

        if (!$usuario) {
            $this->throwError("Usuario no encontrado", "No se encontró usuario con ID " . $this->viewData["usercod"]);
        }

        foreach ($usuario as $key => $value) {
            if (array_key_exists($key, $this->viewData)) {
                $this->viewData[$key] = $value;
            }
        }
    }

    private function getBodyData()
    {
        $fields = [
            "usercod", "username", "useremail", "userpswd", "userpswdest",
            "userpswdexp", "userest", "useractcod", "userpswdchg", "usertipo"
        ];

        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                $this->throwError("Falta el campo: $field");
            }
            $this->viewData[$field] = $_POST[$field];
        }

        if (!isset($_POST["xsrtoken"]) || $_POST["xsrtoken"] !== $_SESSION[$this->name . "-xsrtoken"]) {
            $this->throwError("Token XSR inválido");
        }

        if (intval($_POST["usercod"]) !== $this->viewData["usercod"] && $this->viewData["mode"] !== "INS") {
            $this->throwError("ID del usuario inconsistente");
        }
    }

    private function validateData(): bool
    {
        if (Validators::IsEmpty($this->viewData["username"])) {
            $this->innerError("username", "El nombre de usuario es requerido.");
        }

        if (!filter_var($this->viewData["useremail"], FILTER_VALIDATE_EMAIL)) {
            $this->innerError("useremail", "Correo electrónico inválido.");
        }

        return count($this->viewData["errors"]) === 0;
    }

    private function processData()
    {
        switch ($this->viewData["mode"]) {
            case "INS":
                $result = UsuariosDAO::newusuarios(
                    $this->viewData["useremail"],
                    $this->viewData["username"],
                    $this->viewData["userpswd"],
                    date("Y-m-d"),
                    $this->viewData["userpswdest"],
                    $this->viewData["userpswdexp"],
                    $this->viewData["userest"],
                    $this->viewData["useractcod"],
                    $this->viewData["userpswdchg"],
                    $this->viewData["usertipo"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Usuario creado exitosamente");
                } else {
                    $this->innerError("global", "No se pudo crear el usuario.");
                }
                break;
            case "UPD":
                $result = UsuariosDAO::updateusuario(
                    $this->viewData["usercod"],
                    $this->viewData["username"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Usuario actualizado exitosamente");
                } else {
                    $this->innerError("global", "No se pudo actualizar el usuario.");
                }
                break;
            case "DEL":
                $result = UsuariosDAO::deleteusuario($this->viewData["usercod"]);
                if ($result > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Usuario eliminado exitosamente");
                } else {
                    $this->innerError("global", "No se pudo eliminar el usuario.");
                }
                break;
        }
    }

    private function prepareViewData()
    {
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["username"]
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
