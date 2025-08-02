<?php

namespace Controllers\Maintenance\Admin\Ordenes;

use Controllers\PrivateController;
use DAO\Admin\Ordenes\Orders as OrdersDAO;
use Views\Renderer;

class Orders extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        $this->viewData["orders"] = OrdersDAO::getOrders();
        Renderer::render("maintenance/orders/orders", $this->viewData);
    }
}