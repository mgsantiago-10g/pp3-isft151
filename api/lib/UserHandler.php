<?php

include_once "./DatabaseConnection.php";

class UserHandler
{
    private $connection;

    public function __contruct()
    {
        $this->connection = (new $DatabaseConnection())->getInstance();
    }

    public function create($username, $password)
    {

    }

    public function remove($userId)
    {

    }

    public function update($userId, $username, $password)
    {

    }

    public function get($userId)
    {

    }

    public function getAll()
    {

    }
}
