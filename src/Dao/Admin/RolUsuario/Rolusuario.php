<?php

namespace Dao\Admin\Rolusuario;

use Dao\Table;

class Rolusuario extends Table
{

    public static function getRolusuario(): array
    {
        $sqlstr = "SELECT * FROM roles_usuarios;";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }

    public static function getRolusuarioById(int $id)
    {
        $sqlstr = "SELECT * from roles_usuarios where usercod = :userCod;";
        return self::obtenerUnRegistro($sqlstr, ["userCod" => $id]);
    }

    public static function newrolusuario(string $roleuserest, date $roleuserfch, date $roleuserexp)
    {
        $sqlstr = "INSERT INTO roles_usuarios (roleuserest, roleuserfch, roleuserexp) values (:roleuserest, roleuserfch, roleuserexp);";
        return self::executeNonQuery(
            $sqlstr,
            [
                "roleuserest" => $roleuserest,
                "roleuserfch" => $roleuserfch,
                "roleuserexp" => $roleuserexp,
            ]
        );
    }

    public static function updaterolusuario(int $id, string $rolesdsc, string $rolesest)
    {
        $sqlstr = "UPDATE roles_usuarios set roleuserest = :roleuserest, roleuserfch = :roleuserfch, roleuserexp = :roleuserexp where usercod = :id;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "roleuserest" => $roleuserest,
                "roleuserfch" => $roleuserfch,
                "roleuserexp" => $roleuserexp,
                "usercod" => $id
            ]
        );
    }

    public static function deleterol(int $id)
    {
        $sqlstr = "DELETE FROM roles_usuarios where usercod = :userCod;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "userCod" => $id
            ]
        );
    }
}
