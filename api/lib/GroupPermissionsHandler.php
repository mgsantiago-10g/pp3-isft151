<?php

include_once "./DatabaseConnection.php";

class GroupPermissionsHandler
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new $DatabaseConnection())->getInstance();
    }

    public function addPermission($groupId, $actionId)
    {

    }

    public function removePermission($groupId, $actionId)
    {

    }

    public function getPermission($groupId, $actionId)
    {

    }

    public function getAllPermissions($groupId)
    {
        
    }
}
?>