<?php
namespace Controllers\Maintenance\Cliente\Catalogo;

use Controllers\PublicController;
use Dao\Cliente\Catalogo\TempLibros;
use Views\Renderer;

class AgregarTemp extends PublicController
{
    private array $viewData = [];

    public function run(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $idLibro = $_POST["id_libro"] ?? null;
            $titulo = $_POST["titulo"] ?? null;
            $precio = floatval($_POST["precio"]) ?? null;

            if ($idLibro) {
                TempLibros::insert($idLibro, $titulo, $precio);
                $this->viewData["mensaje"] = "Libro agregado correctamente al carrito.";
            } else {
                $this->viewData["mensaje"] = "Error: ID de libro no válido.";
            }
        } else {
            $this->viewData["mensaje"] = "Acceso inválido.";
        }

        Renderer::render("agregado", $this->viewData);
    }
}
