<?php

namespace Controllers\Maintenance\Admin\Funciones;

use Controllers\PrivateController;
use DAO\Admin\Funciones\Funciones as FuncionesDAO;
use Views\Renderer;

class Funciones extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        $this->viewData["funciones"] = FuncionesDAO::getFunciones();
        Renderer::render("funciones", $this->viewData);
    }
}