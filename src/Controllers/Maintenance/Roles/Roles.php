<?php

namespace Controllers\Maintenance\Roles;

use Controllers\PrivateController;
use DAO\Roles\Roles as RolesDAO;
use Views\Renderer;

class Roles extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        $this->viewData["roles"] = RolesDAO::getRoles();
        \Views\Renderer::render("roles", $this->viewData);

    }
}