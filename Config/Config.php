<?php

class Config
{
    /*
    * Método estático que realiza la conexión a la DB
    * @return object - Conexión a la DB - $sqlite
    */
    public static function connect()
    {        
        $sqlite = new SQLite3('data.db');

        return $sqlite;
    }
}