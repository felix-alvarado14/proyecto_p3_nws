<?php

namespace Dao\Roles;

use Dao\Table;

class Roles extends Table
{

    public static function getRoles(): array
    {
        $sqlstr = "SELECT * FROM roles;";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }

    public static function getRolesById(int $id)
    {
        $sqlstr = "SELECT * from roles where rolescod = :rolesCod;";
        return self::obtenerUnRegistro($sqlstr, ["rolesCod" => $id]);
    }

    public static function newrol(string $rolesdsc, string $rolesest)
    {
        $sqlstr = "INSERT INTO roles (rolesdsc, rolesest) values (:rolesdsc, rolesest);";
        return self::executeNonQuery(
            $sqlstr,
            [
                "rolesdsc" => $rolesdsc,
                "rolesest" => $rolesest
            ]
        );
    }

    public static function updaterol(int $id, string $rolesdsc, string $rolesest)
    {
        $sqlstr = "UPDATE roles set rolesdsc = :rolesdsc, rolesest = :rolesest where rolescod = :id;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "rolesdsc" => $rolesdsc,
                "rolesest" => $rolesest,
                "rolescod" => $id
            ]
        );
    }

    public static function deleterol(int $id)
    {
        $sqlstr = "DELETE FROM roles where rolescod = :rolesCod;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "rolesCod" => $id
            ]
        );
    }
}
