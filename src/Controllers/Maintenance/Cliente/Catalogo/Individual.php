<?php

namespace Controllers\Maintenance\Cliente\Catalogo;

use Controllers\PublicController;
use Dao\Cliente\Catalogo\Catalogo as CatalogoDAO;
use Views\Renderer;
use Utilities\Site;

const LIST_URL = "index.php?page=Maintenance-Cliente-Catalogo-Catalogo";

class Individual extends PublicController
{
    private array $viewData = [];

    public function run(): void
    {
        $this->init();
        $this->getQueryParamsData();
        $this->getDataFromDB();
        $this->prepareViewData();
        Renderer::render("maintenance/catalogo/individual", $this->viewData);
    }

    private function init()
    {
        $this->viewData = [
            "mode" => "DSP",
            "id_libro" => 0,
            "titulo" => "",
            "precio" => 0.0,
            "modeDsc" => "",
            "cancelLabel" => "Back",
            "showConfirm" => false,
            "readonly" => "readonly"
        ];
    }

    private function getQueryParamsData()
    {
        if (!isset($_GET["id_libro"]) || !is_numeric($_GET["id_libro"])) {
            $this->throwError("Invalid or missing book ID");
        }
        $this->viewData["id_libro"] = intval($_GET["id_libro"]);
    }

    private function getDataFromDB()
    {
        $tmpLibro = CatalogoDAO::getBooksById($this->viewData["id_libro"]);

        if (!$tmpLibro) {
            $this->throwError("Book not found");
        }

        $this->viewData["titulo"] = $tmpLibro["titulo"];
        $this->viewData["precio"] = $tmpLibro["precio"];
    }

    private function prepareViewData()
    {
        $this->viewData["modeDsc"] = sprintf("Detalles del libro: \"%s\"", $this->viewData["titulo"]);
        $this->viewData["xsrtoken"] = hash("sha256", json_encode($this->viewData));
        $_SESSION[$this->name . "-xsrtoken"] = $this->viewData["xsrtoken"];
    }

    private function throwError(string $message)
    {
        Site::redirectToWithMsg(LIST_URL, $message);
    }
}
