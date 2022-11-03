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
    const ERR_INVALID_INPUT_DATA = 1;
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
        if($name == null || $description == null)
        {
            throw new Exception("Datos inválidos", GroupHandlerErrorTypes ::ERR_INVALID_INPUT_DATA);
        }

        $SQLStatement = $this->connection->prepare("CALL `usp_create_group`(:name, :description)");
        $SQLStatement->bindParam(':name', $name);
        $SQLStatement->bindParam(':description', $description);
        $SQLStatement->execute();
    }

    public function remove ( int $group_id)
    {
        if($group_id == null || $group_id <= 0 )
        {
            throw new Exception("Datos inválidos", GroupHandlerErrorTypes ::ERR_INVALID_INPUT_DATA);
        }

        $SQLStatement = $this->connection->prepare("CALL `usp_delete_group`(:groupId)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->execute();
    }

    public function update (int $group_id, string $name, string $description)
    {
        if($group_id == null || $group_id <= 0 || $name == null || $description == null)
        {
            throw new Exception("Datos inválidos", GroupHandlerErrorTypes ::ERR_INVALID_INPUT_DATA);
        }
        $SQLStatement = $this->connection->prepare("CALL `usp_update_group`(:groupId, :name, :description)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->bindParam(':name', $name);
        $SQLStatement->bindParam(':description', $description);
        $SQLStatement->execute();
    }

    public function get ( int $group_id)
    {
        if($group_id == null || $group_id <= 0 )
        {
            throw new Exception("Datos inválidos", GroupHandlerErrorTypes ::ERR_INVALID_INPUT_DATA);
        }
        $SQLStatement = $this->connection->prepare("CALL `usp_get_group`(:groupId)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function getAll()
    {
        
        $SQLStatement = $this->connection->prepare("CALL `usp_getAll_group`");
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);


    }
    
 }
 
?>
