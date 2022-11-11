<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";

 class GroupHandlerErrorTypes
 {
    const ERR_INVALID_ENTITY_ID = 1;
    const ERR_CREATE_GROUP = 2;
    const ERR_REMOVE_GROUP = 3;
    const ERR_UPDATE_GROUP = 4;
    const ERR_GET_GROUP = 5;
    const ERR_GET_ALL_GROUPS = 6;
 }
 class GroupHandler
 {
    private $connection;

    public function __construct()
    {
        $connection = (new DataBaseConnection())->getInstance();
    }

    public function create ( string $name, string $description)
    {
        if($name == null || $name == "" || $description == null|| $description == "" )
        {
            throw new Exception("Invalid data", GroupHandlerErrorTypes ::ERR_CREATE_GROUP);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_create_group`(:name, :description)");
            $SQLStatement->bindParam(':name', $name);
            $SQLStatement->bindParam(':description', $description);
            $SQLStatement->execute();
        } catch ( PDOException $dbException) {
            throw new Exception( "Error creating group ", GroupHandlerErrorTypes::ERR_CREATE_GROUP);
        }
    }

    public function remove ( int $group_id)
    {
        if($group_id == null || $group_id == "" || $group_id <= 0 )
        {
            throw new Exception("Invalid data", GroupHandlerErrorTypes ::ERR_REMOVE_GROUP);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_delete_group`(:groupId)");
            $SQLStatement->bindParam(':groupId', $group_id);
            $SQLStatement->execute();
        } catch(PDOException $dbException) {
            throw new Exception("Error removing group", GroupHandlerErrorTypes::ERR_REMOVE_GROUP);
        }
    }

    public function update (int $group_id, string $name, string $description)
    {
        if($group_id == null || $group_id == "" || $group_id <= 0 || $name == "" || $name == null || $description == null || $description == "")
        {
            throw new Exception("Invalid data", GroupHandlerErrorTypes ::ERR_UPDATE_GROUP);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_update_group`(:groupId, :name, :description)");
            $SQLStatement->bindParam(':groupId', $group_id);
            $SQLStatement->bindParam(':name', $name);
            $SQLStatement->bindParam(':description', $description);
            $SQLStatement->execute();
        } catch (PDOException $dbException){
            throw new Exception("Error updating group", GroupHandlerErrorTypes::ERR_UPDATE_GROUP);
        }

    }

    public function get ( int $group_id)
    {
        if($group_id == null || $group_id == "" || $group_id <= 0 )
        {
            throw new Exception("Invalid data", GroupHandlerErrorTypes ::ERR_GET_GROUP);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_get_group`(:groupId)");
            $SQLStatement->bindParam(':groupId', $group_id);
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $dbException){
            throw new Exception("Error getting group", GroupHandlerErrorTypes::ERR_GET_GROUP);
        }
        
    }

    public function getAll()
    {
        try {
            $SQLStatement = $this->connection->prepare("CALL `usp_getAll_group`");
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $dbException) {
            throw new Exception("Error getting all groups", GroupHandlerErrorTypes::ERR_GET_ALL_GROUPS);
        }


    }
    
 }
 
?>
