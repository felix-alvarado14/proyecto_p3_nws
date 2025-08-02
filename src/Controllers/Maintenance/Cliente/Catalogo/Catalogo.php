<?php

namespace Controllers\Maintenance\Cliente\Catalogo;

use Controllers\PublicController;
use DAO\Cliente\Catalogo\Catalogo as CatalogoDAO;
use Views\Renderer;

use Dao\Cart\Cart;

use Utilities\Site;

class Catalogo extends PublicController{
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