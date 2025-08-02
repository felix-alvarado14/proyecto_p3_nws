<?php
namespace Dao\Cliente\Ordenes;

use Dao\Table;

class Orders extends Table
{
    public static function newOrder($id_orden, $id_usuario)
    {
        $sql = "INSERT INTO ordenes (id_orden, id_usuario) VALUES (:id_orden, :id_usuario);";
        $params = [
            "id_orden" => $id_orden,
            "id_usuario" => $id_usuario
        ];
        return self::executeNonQuery($sql, $params);
    }

    public static function newOrderDetails($id_orden, $id_libro)
    {
        $sql = "INSERT INTO orden_detalles (id_orden, id_libro) VALUES (:id_orden, :id_libro);";
        $params = [
            "id_orden" => $id_orden,
            "id_libro" => $id_libro
        ];
        return self::executeNonQuery($sql, $params);
    }
}
