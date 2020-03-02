<?php

class Config
{
    /*
    * Método estático que realiza la conexión a la DB
    * @acces public
    * @params none
    * @return object - Conexión a la DB - $mysqli
    */
    public static function connect()
    {
        // $mysqli = new mysqli('localhost', 'root', '', 'tienda_master');
        $sqlite = new SQLite3('data.db');

        // if(!$mysqli->set_charset('utf8'))
        // {
            // echo "Ha ocurrido un error al intentar definir el juego de caracteres";
            // exit();
        // }

        return $sqlite;
    }
}
// $sqlite = new SQLite3('data.db');
// var_dump($sqlite);

// $bd->exec('CREATE TABLE foo (bar STRING)');
// $bd->exec("INSERT INTO foo (bar) VALUES ('Esto es una prueba')");

// $resultado = $sqlite->query('SELECT * FROM master_products_configurable limit 1');
// var_dump($resultado->fetchArray());