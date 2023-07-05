<?php

class Database
{
    public $connecton;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=myapp;user=jesper;password=superhemligt;charset=utf8mb4";

        $this->connecton = new PDO($dsn);
    }
    public function query($query)
    {

        $statement = $this->connecton->prepare($query);
        $statement->execute();

        return $statement;
    }
}
