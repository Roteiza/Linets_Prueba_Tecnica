<?php
require_once 'Config/Config.php';

class Home
{
    private $sqlite;

    public function __construct()
    {
        $this->sqlite = Config::connect();
    }

    /**
     * Ejecutar sentencia SQL
     * @param string - $query - Sentencia SQL
     * @return object - $result - Resultado Query
     */
    public function queryExecute($query)
    {
        $result = $this->sqlite->query($query);
        
        return $result;
    }
}