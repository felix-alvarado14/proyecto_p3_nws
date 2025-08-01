<?php

namespace Controllers;

use \Dao\Books\Books as ProductsDao;
use \Views\Renderer as Renderer;
use \Utilities\Site as Site;

class HomeController extends PublicController
{
  public function run(): void
  {
    Site::addLink("public/css/products.css");
    $viewData = [];
    $viewData["productsOnSale"] = Books::getDailyDeals();
    $viewData["productsHighlighted"] = Books::getFeaturedProducts();
    $viewData["productsNew"] = Books::getNewProducts();
    Renderer::render("home", $viewData);
  }
}
?>