<?php
require_once 'Config/Config.php';

class Home
{
    private $sqlite;

    public function __construct()
    {
        $this->sqlite = Config::connect();
    }

    public function queryExecute($query)
    {
        $result = $this->sqlite->query($query);
        // var_dump($result->fetchArray());
        // die;
        return $result;
    }
}