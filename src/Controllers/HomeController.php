<?php

namespace Controllers;

use \Dao\Books\Books as ProductsDao;
use \Views\Renderer as Renderer;
use \Utilities\Site as Site;

class HomeController extends PublicController
{
  public function run(): void
  {
        Site::addLink("public/css/landing.css");
        $viewData = array();
        \Views\Renderer::render("index", $viewData);
  }
}
?>