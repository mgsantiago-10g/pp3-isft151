<?php

class DatabaseConnection
{
    private $connection;

    public function __construct()
    {
        try
        {
            $filePath = __DIR__ . '/../../config/database.json';
            $configFile = json_decode(file_get_contents($filePath));
            $host = $configFile->host;
            $user = $configFile->user;
            $pass = $configFile->pass;
            $dbName = $configFile->name;
            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $dbName, $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $connectionException) {
            $status = array('status' => 'db-error', 'description' => $connectionException->getMessage());
            echo json_encode($status);
            die();
        };
    }

    public function getInstance()
    {
        return $this->connection;
    }
};
