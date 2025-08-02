<?php

namespace Dao\Admin\Books;

use Dao\Table;

class Books extends Table
{

    public static function getBooks(): array
    {
        $sqlstr = "SELECT * FROM libros;";
        return self::obtenerRegistros(
            $sqlstr,
            []
        );
    }

    public static function getBooksById(int $id)
    {
        $sqlstr = "SELECT * from libros where id_libro = :idLibro;";
        return self::obtenerUnRegistro($sqlstr, ["idLibro" => $id]);
    }

    public static function newbook(string $titulo, string $autor, string $genero, int $ano, string $editora, float $precio)
    {
        $sqlstr = "INSERT INTO libros (titulo, autor, genero, publicacion_year, editora, precio) values (:titulo, :autor, :genero, :ano, :editora, :precio);";
        return self::executeNonQuery(
            $sqlstr,
            [
                "titulo" => $titulo,
                "autor" => $autor,
                "genero" => $genero,
                "ano" => $ano,
                "editora" => $editora,
                "precio" => $precio
            ]
        );
    }

    public static function updateBook(int $id, string $titulo, string $autor, string $genero, string $ano, string $editora, float $precio)
    {
        $sqlstr = "UPDATE libros set titulo = :titulo, autor = :autor, genero = :genero, publicacion_year = :ano, editora = :editora, precio = :precio where id_libro = :id;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "titulo" => $titulo,
                "autor" => $autor,
                "genero" => $genero,
                "ano" => $ano,
                "editora" => $editora,
                "precio" => $precio,
                "id" => $id
            ]
        );
    }

    public static function deleteBook(int $id)
    {
        $sqlstr = "DELETE FROM libros where id_libro = :id;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "id" => $id
            ]
        );
    }
}
