<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
use Dao\Cliente\Catalogo\TempLibros;
use Dao\Cliente\Ordenes\Orders;

class Accept extends PublicController
{
    public function run(): void
    {
        Orders::newOrder($_SESSION["orderid"], $_SESSION["usercod"]);

        $carrito = TempLibros::getAll();

        foreach($carrito as $libro){
            Orders::newOrderDetails($_SESSION["orderid"], $libro["id_libro"]);
        }

        TempLibros::deleteAll();

        $dataview = array();
        $token = $_GET["token"] ?: "";
        $session_token = $_SESSION["orderid"] ?: "";
        if ($token !== "" && $token == $session_token) {
            $PayPalRestApi = new \Utilities\PayPal\PayPalRestApi(
                \Utilities\Context::getContextByKey("PAYPAL_CLIENT_ID"),
                \Utilities\Context::getContextByKey("PAYPAL_CLIENT_SECRET")
            );
            $result = $PayPalRestApi->captureOrder($session_token);
            $dataview["orderjson"] = json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $dataview["orderjson"] = "No Order Available!!!";
        }
        \Views\Renderer::render("paypal/accept", $dataview);
    }
}