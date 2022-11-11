<?php

include_once "DatabaseConnection.php";

class UserHandlerErrorTypes
{
    const ERR_INVALID_USER_PASSWORD = 15;
    const ERR_INVALID_ENTITY_ID = 14;
    const ERR_CREATE_USER = 13;
    const ERR_DELETE_USER = 12;
    const ERR_UPDATE_USER = 11;
    const ERR_GET_USER = 10;
    const ERR_GET_ALL_USER = 9;
}

class UserHandler
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new DatabaseConnection())->getInstance();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function create(string $username, string $password)
    {
        if ($username == "" || $password == "") {
            throw new Exception("Invalid username and/or password", UserHandlerErrorTypes::ERR_INVALID_USER_PASSWORD);
        }

        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_create_user`(:username, :password)");
            $SQLStatement->bindParam(':username', $username);
            $SQLStatement->bindParam(':password', $password);
            $SQLStatement->execute();
        } catch (PDOException $dbException) {
            throw new Exception("Error creating user", UserHandlerErrorTypes::ERR_CREATE_USER);
        }
    }

    public function remove(int $userId)
    {
        if ($userId <= 0) {
            throw new Exception("Invalid id", UserHandlerErrorTypes::ERR_INVALID_ENTITY_ID);
        }

        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_delete_user`(:id)");
            $SQLStatement->bindParam(':id', $userId);
            $SQLStatement->execute();
        } catch (PDOException $dbException) {
            throw new Exception("Error deleting user", UserHandlerErrorTypes::ERR_DELETE_USER);
        }
    }

    public function update(int $userId, string $username, string $password)
    {
        if ($username == "" || $password == "") {
            throw new Exception("Invalid username and/or password", UserHandlerErrorTypes::ERR_INVALID_USER_PASSWORD);
        }

        if ($userId <= 0) {
            throw new Exception("Invalid id", UserHandlerErrorTypes::ERR_INVALID_ENTITY_ID);
        }

        try {
            //toDo: improve design
            $SQLStatement = $this->connection->prepare("CALL `usp_update_user`(:id, :username, :password)");
            $SQLStatement->bindParam(':id', $userId);
            $SQLStatement->bindParam(':username', $username);
            $SQLStatement->bindParam(':password', $password);
            $SQLStatement->execute();
        } catch (PDOException $dbException) {
            throw new Exception("Error updating user", UserHandlerErrorTypes::ERR_UPDATE_USER);
        }
    }

    public function get(int $userId)
    {
        if ($userId <= 0) {
            throw new Exception("Invalid id", UserHandlerErrorTypes::ERR_INVALID_ENTITY_ID);
        }

        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_get_user`(:id)");
            $SQLStatement->bindParam(':id', $userId);
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $dbException) {
            throw new Exception("Error retrieving user", UserHandlerErrorTypes::ERR_GET_USER);
        }
    }

    public function getAll()
    {
        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_getAll_user`");
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $dbException) {
            throw new Exception("Error retrieving all users", UserHandlerErrorTypes::ERR_GET_ALL_USER);
        }
    }
}