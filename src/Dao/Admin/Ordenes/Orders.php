<?php

namespace Dao\Admin\Ordenes;

use Dao\Table;

class Orders extends Table
{

    public static function getOrders(): array
    {
        $sqlstr = "SELECT * FROM vw_ordenes_usuarios;";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }
}
