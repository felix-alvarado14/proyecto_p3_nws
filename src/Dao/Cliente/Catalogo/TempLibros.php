<?php
namespace Dao\Cliente\Catalogo;

use Dao\Table;

class TempLibros extends Table
{
    public static function insert($idLibro)
    {
        $sql = "INSERT INTO temp (id_libro) VALUES (:id_libro);";
        $params = ["id_libro" => $idLibro];
        return self::executeNonQuery($sql, $params);
    }
}
