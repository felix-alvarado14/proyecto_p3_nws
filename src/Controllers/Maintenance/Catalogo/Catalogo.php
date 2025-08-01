<?php

namespace Controllers\Maintenance\Catalogo;

use Controllers\PrivateController;
use DAO\Catalogo\Catalogo as CatalogoDAO;
use Views\Renderer;

use Dao\Cart\Cart;

use Utilities\Site;

class Catalogo extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        Site::addLink("public/css/book.css");
        $this->viewData["books"] = CatalogoDAO::getBooks();
        Renderer::render("maintenance/catalogo/catalogo", $this->viewData);
    }
}