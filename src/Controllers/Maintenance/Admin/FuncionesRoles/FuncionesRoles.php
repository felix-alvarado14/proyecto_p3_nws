<?php

namespace Controllers\Maintenance\Admin\FuncionesRoles;

use Controllers\PrivateController;
use DAO\Admin\FuncionesRoles\FuncionesRoles as FuncionesRolesDAO;
use Views\Renderer;

class FuncionesRoles extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        $this->viewData["funcionesroles"] = FuncionesRolesDAO::getFuncionesRoles();
        Renderer::render("funcionesroles", $this->viewData);
    }
}