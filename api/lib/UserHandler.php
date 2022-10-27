<?php

include_once "./DatabaseConnection.php";

class UserHandler
{
    private $connection;

    public function __contruct()
    {
        $this->connection = (new DatabaseConnection())->getInstance();
    }

    public function create($username, $password)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_create_user`(:username, :password)");
        $SQLStatement->bindParam(':username', $username);
        $SQLStatement->bindParam(':password', $password);
        $SQLStatement->execute();
    }

    public function remove($userId)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_delete_user`(:id)");
        $SQLStatement->bindParam(':id', $userId);
        $SQLStatement->execute();
    }

    public function update($userId, $username, $password)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_update_user`(:id, :username, :password)");
        $SQLStatement->bindParam(':id', $userId);
        $SQLStatement->bindParam(':username', $username);
        $SQLStatement->bindParam(':password', $password);
        $SQLStatement->execute();
    }

    public function get($userId)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_get_user`(:id)");
        $SQLStatement->bindParam(':id', $userId);
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);
    }

    public function getAll()
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_getAll_user`");
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);
    }
}
