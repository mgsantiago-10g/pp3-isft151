<?php

include_once "DatabaseConnection.php";

class GroupPermissionsHandlerErrorTypes
{
    const ERR_GET_ALL_PERMISSION = 19;
    const ERR_GET_PERMISSION = 18;
    const ERR_DELETE_PERMISSION = 17;
    const ERR_ADD_PERMISSION = 16;
    const ERR_INVALID_ENTITY_ID = 14;
}

class GroupPermissionsHandler
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new DatabaseConnection())->getInstance();
    }

    public function addPermission(int $groupId, int $actionId)
    {
        if ($groupId <= 0 || $actionId <= 0) {
            throw new Exception("Invalid id", GroupPermissionsHandlerErrorTypes::ERR_INVALID_ENTITY_ID);
        }
        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_create_group_permissions`(:groupId, :actionId)");
            $SQLStatement->bindParam(':groupId', $groupId);
            $SQLStatement->bindParam(':actionId', $actionId);
            $SQLStatement->execute();
        } catch (PDOException $dbException) {
            throw new Exception("Error adding permission", GroupPermissionsHandlerErrorTypes::ERR_ADD_PERMISSION);
        }
    }

    public function removePermission(int $groupId, int $actionId)
    {
        if ($groupId <= 0 || $actionId <= 0) {
            throw new Exception("Invalid id", GroupPermissionsHandlerErrorTypes::ERR_INVALID_ENTITY_ID);
        }
        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_delete_group_permissions`(:groupId, :actionId)");
            $SQLStatement->bindParam(':groupId', $groupId);
            $SQLStatement->bindParam(':actionId', $actionId);
            $SQLStatement->execute();
        } catch (PDOException $connectionException) {
            throw new Exception("Error deleting permission", GroupPermissionsHandlerErrorTypes::ERR_DELETE_PERMISSION);
        }
    }

    public function getPermissions(int $groupId)
    {
        if ($groupId <= 0) {
            throw new Exception("Invalid id", GroupPermissionsHandlerErrorTypes::ERR_INVALID_ENTITY_ID);
        }
        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_get_group_permissions`(:groupId)");
            $SQLStatement->bindParam(':groupId', $groupId);
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $connectionException) {
            throw new Exception("Error retrieving permission", GroupPermissionsHandlerErrorTypes::ERR_GET_PERMISSION);
        }
    }

    public function getAllPermissions()
    {
        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_getAll_group_permissions`");
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $connectionException) {
            throw new Exception("Error retrieving permissions", GroupPermissionsHandlerErrorTypes::ERR_GET_ALL_PERMISSION);
        }
    }
}
