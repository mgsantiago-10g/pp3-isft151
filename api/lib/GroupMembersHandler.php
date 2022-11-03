<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";

class GroupMemberHandlerErrorTypes
{
    const ERR_INVALID_INPUT_DATA = 1;
}
 class GroupMemberHandler
 {
    private $connection;

    public function __construct()
    {
        $connection = (new DataBaseConnection())->getInstance();
    }

    public function addUser(int $group_id, int $user_id)
    {
        if( $user_id <= 0 || $user_id == null || $group_id == null || $group_id <= 0)
        {
            throw new Exception("Datos no válidos", GroupMemberHandlerErrorTypes::ERR_INVALID_INPUT_DATA);
        }
        $SQLStatement = $this->connection->prepare("CALL `usp_create_group_user_members`(:groupId, :userId)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->bindParam(':userId', $user_id);
        $SQLStatement->execute();
    }

    public function removeUser(int $group_id, int $user_id)
    {
        if( $user_id <= 0 || $user_id == null || $group_id == null || $group_id <= 0)
        {
            throw new Exception("Datos no válidos", GroupMemberHandlerErrorTypes::ERR_INVALID_INPUT_DATA);
        }
        $SQLStatement = $this->connection->prepare("CALL `usp_delete_group_user_members`(:groupId, :userId)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->bindParam(':userId', $user_id);
        $SQLStatement->execute();
        
    }

    public function getUser(int $group_id, int $user_id)
    {
        if( $user_id <= 0 || $user_id == null || $group_id == null || $group_id <= 0)
        {
            throw new Exception("Datos no válidos", GroupMemberHandlerErrorTypes::ERR_INVALID_INPUT_DATA);
        }
        $SQLStatement = $this->connection->prepare("CALL `usp_get_group_user_members`(:groupId, :userId)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->bindParam(':userId', $user_id);
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        
       
    }

    public function getAllUsers()
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_getAll_group_user_members`");
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        
    }

 }
 ?>