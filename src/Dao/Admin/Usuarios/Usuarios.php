<?php

namespace Dao\Admin\Usuarios;

use Dao\Table;

class Usuarios extends Table
{

    public static function getUsuarios(): array
    {
        $sqlstr = "SELECT * FROM usuario;";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }

    public static function getUsuariosById(int $id)
    {
        $sqlstr = "SELECT * from usuario where usercod = :userCod;";
        return self::obtenerUnRegistro($sqlstr, ["userCod" => $id]);
    }

    public static function newusuarios(string $useremail, string $username, string $userpswd, date $userfching, string $userpswdest, date $userpswdexp, string $userest, string $useractcod, string $userpswdchg, string $usertipo)
    {
        $sqlstr = "INSERT INTO usuario (useremail, username, userpswd, userfching, userpswdest, userpswdexp, userest, useractcod, userpswdchg, usertipo) values (:useremail, :username, :userpswd, :NOW(), :userpswdest, :userpswdexp, :userest, :useractcod, :userpswdchg, :usertipo);";
        return self::executeNonQuery(
            $sqlstr,
            [
                "useremail" => $useremail,
                "username" => $username,
                "userpswd" => $userpswd,
                "userfching" => $userfching,
                "userpswdest" => $userpswdest,
                "userpswdexp" => $userpswdexp,
                "userest" => $userest,
                "useractcod" => $useractcod,
                "userpswdchg" => $userpswdchg,
                "usertipo" => $usertipo,
            ]
        );
    }

    public static function updateusuario(int $id, string $username)
    {
        $sqlstr = "UPDATE usuario set username = :username where usercod = :id;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "username" => $username,
                "usercod" => $id
            ]
        );
    }

    public static function deleteusuario(int $id)
    {
        $sqlstr = "DELETE FROM usuario where usercod = :userCod;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "userCod" => $id
            ]
        );
    }
}
