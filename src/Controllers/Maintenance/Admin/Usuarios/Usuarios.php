<?php

namespace Controllers\Maintenance\Admin\Usuarios;

use Controllers\PrivateController;
use DAO\Admin\Usuarios\Usuarios as UsuariosDAO;
use Views\Renderer;

class Usuarios extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        $this->viewData["usuarios"] = UsuariosDAO::getUsuarios();
        \Views\Renderer::render("usuarios", $this->viewData);

    }
}