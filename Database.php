<?php

class Database
{
    public $connecton;


    public function __construct($config, $username = 'jesper', $password = 'superhemligt')
    {


        $dsn = 'mysql:' . http_build_query($config, '', ';');


        $this->connecton = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = [])
    {

        $statement = $this->connecton->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}
