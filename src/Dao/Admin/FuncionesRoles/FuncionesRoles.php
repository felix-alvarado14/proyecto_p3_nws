<?php

namespace Dao\Admin\FuncionesRoles;

use Dao\Table;

class FuncionesRoles extends Table
{

    public static function getFuncionesRoles(): array
    {
        $sqlstr = "SELECT * FROM funciones_roles;";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }

    public static function getFuncionesRolesById(int $id)
    {
        $sqlstr = "SELECT * from funciones_roles where rolescod = :rolesCod;";
        return self::obtenerUnRegistro($sqlstr, ["rolesCod" => $id]);
    }

    public static function newfuncionesroles(string $fnrolest, date $fnexp)
    {
        $sqlstr = "INSERT INTO funciones_roles (fnrolest, fnexp) values (:fnrolest, :fnexp);";
        return self::executeNonQuery(
            $sqlstr,
            [
                "fnrolest" => $fnrolest,
                "fnrolexp" => $fnexp,
            ]
        );
    }

    public static function updatefuncionesroles(int $id, string $fnrolest, date $fnexp)
    {
        $sqlstr = "UPDATE funciones_roles set fnrolest = :fnrolest, fnexp = :fnexp where rolescod = :id;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "fnrolest" => $fnrolest,
                "fnexp" => $fnexp,
                "rolescod" => $id
            ]
        );
    }

    public static function deletefuncionesroles(int $id)
    {
        $sqlstr = "DELETE FROM funciones_roles where rolescod = :rolesCod;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "rolesCodd" => $id
            ]
        );
    }
}
