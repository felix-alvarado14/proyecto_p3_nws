<?php

namespace Controllers\Maintenance\Admin\Books;

use Controllers\PrivateController;
use DAO\Admin\Books\Books as BooksDAO;
use Views\Renderer;

class Books extends PrivateController{
    private array $viewData;

    public function __construct(){
        $this->viewData = [];
    }

    public function run() : void{
        $this->viewData["books"] = BooksDAO::getBooks();
        Renderer::render("maintenance/books/books", $this->viewData);
    }
}