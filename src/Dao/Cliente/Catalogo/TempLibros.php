<?php
namespace Dao\Cliente\Catalogo;

use Dao\Table;

class TempLibros extends Table
{
    public static function insert($idLibro, $titulo, $precio)
    {
        $sql = "INSERT INTO tempor (id_libro, titulo, precio) VALUES (:id_libro, :titulo, :precio);";
        $params = [
            "id_libro" => $idLibro,
            "titulo" => $titulo,
            "precio" => $precio
        ];
        return self::executeNonQuery($sql, $params);
    }

    public static function getAll(){
        $sqlstr = "SELECT * FROM Tempor";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }

    public static function deleteAll(){
        $sqlstr = "DELETE FROM Tempor";
        return self::executeNonQuery(
            $sqlstr,
            []
        );
    }
}
