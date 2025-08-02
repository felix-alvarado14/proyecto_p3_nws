<?php
namespace Controllers\Checkout;

use Dao\Cliente\Catalogo\TempLibros; // esta es tu tabla tempor
/*use Utilities\PayPal\PayPalRestApi;*/
use Utilities\PayPal\PayPalOrder;
use Controllers\PublicController;

class Checkout extends PublicController
{
    public function run(): void
    {
        // Paso 1: Obtener productos del carrito
        $productos = TempLibros::getAll(); // asegúrate de que esta función devuelva todos los productos
        
        $items = [];
        $total = 0;

        foreach ($productos as $producto) {
            $items[] = [
                "name" => $producto["titulo"],
                "unit_amount" => [
                    "currency_code" => "USD",
                    "value" => number_format($producto["precio"], 2, '.', '')
                ],
                "quantity" => "1"
            ];
            $total += floatval($producto["precio"]);
        }

        // Paso 2: Crear la orden
        $orden = new PayPalOrder(
            "test" . (time() - 10000000),
            "http://localhost:8080/NW/mvcNWS202502/index.php?page=Checkout_Error",
            "http://localhost:8080/NW/mvcNWS202502/index.php?page=Checkout_Accept"
        );

        foreach($productos as $producto){
            $orden->addItem(
                $producto["titulo"],
                $producto["titulo"],
                $producto["id_libro"],
                $producto["precio"],
                0,
                1,
                "DIGITAL_GOODS"
            );
        }

        $PayPalRestApi = new \Utilities\PayPal\PayPalRestApi(
            \Utilities\Context::getContextByKey("PAYPAL_CLIENT_ID"),
            \Utilities\Context::getContextByKey("PAYPAL_CLIENT_SECRET")
        );

        $PayPalRestApi->getAccessToken();
        $response = $PayPalRestApi->createOrder($orden);

        /*
        if (!isset($response->id)) {
            echo "<pre>";
            print_r($response);
            echo "</pre>";
            die("No se pudo obtener el ID de la orden");
        }
        */

        $_SESSION["orderid"] = $response->id;

        foreach ($response->links as $link) {
            if ($link->rel == "approve") {
                \Utilities\Site::redirectTo($link->href);
            }
        }
        die();
    }
}
