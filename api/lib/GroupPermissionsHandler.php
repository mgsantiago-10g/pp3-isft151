<?php

include_once "./DatabaseConnection.php";

class GroupPermissionsHandler
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new DatabaseConnection())->getInstance();
    }

    public function addPermission($groupId, $actionId)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_create_group_permissions`(:groupId, :actionId)");
        $SQLStatement->bindParam(':groupId', $groupId);
        $SQLStatement->bindParam(':actionId', $actionId);
        $SQLStatement->execute();
    }

    public function removePermission($groupId, $actionId)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_delete_group_permissions`(:groupId, :actionId)");
        $SQLStatement->bindParam(':groupId', $groupId);
        $SQLStatement->bindParam(':actionId', $actionId);
        $SQLStatement->execute();
    }

    public function getPermission($groupId, $actionId)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_get_group_permissions`(:groupId, :actionId)");
        $SQLStatement->bindParam(':groupId', $groupId);
        $SQLStatement->bindParam(':actionId', $actionId);
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);
    }

    public function getAllPermissions()
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_getAll_group_permissions`");
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);
    }
}
?>