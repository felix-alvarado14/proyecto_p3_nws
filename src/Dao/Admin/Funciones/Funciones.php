<?php

namespace Dao\Admin\Funciones;

use Dao\Table;

class Funciones extends Table
{

    public static function getFunciones(): array
    {
        $sqlstr = "SELECT * FROM funciones;";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }

    public static function getFuncionesById(int $id)
    {
        $sqlstr = "SELECT * from funciones where fncod = :fnCod;";
        return self::obtenerUnRegistro($sqlstr, ["fnCod" => $id]);
    }

    public static function newfuncion(string $fndsc, string $fnest, string $fntyp)
    {
        $sqlstr = "INSERT INTO funciones (fndsc, fnest, fntyp) values (:fndsc, :fnest, :fntyp);";
        return self::executeNonQuery(
            $sqlstr,
            [
                "fndsc" => $fndsc,
                "fnest" => $fnest,
                "fntypt" => $fntyp,
            ]
        );
    }

    public static function updatefuncion(int $id, string $fndsc, string $fnest, string $fntyp)
    {
        $sqlstr = "UPDATE funciones set fndsc = :fndsc, fnest = :fnest, fntyp = :fntyp where fncod = :id;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "fndsc" => $fndsc,
                "fnest" => $fnest,
                "fntyp" => $fntyp,
                "fnscod" => $id
            ]
        );
    }

    public static function deletefuncion(int $id)
    {
        $sqlstr = "DELETE FROM funciones where fncod = :fnsCod;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "fnCod" => $id
            ]
        );
    }
}
