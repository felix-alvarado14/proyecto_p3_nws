<?php

namespace Controllers\Maintenance\Admin\RolUsuario;

use Controllers\PrivateController;
use DAO\Admin\RolUsuario\Rolusuario as RolusuarioDAO;
use Views\Renderer;

class Rolusuario extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        $this->viewData["rolusuario"] = RolusuarioDAO::getRolusuario();
        \Views\Renderer::render("rolusuario", $this->viewData);

    }
}