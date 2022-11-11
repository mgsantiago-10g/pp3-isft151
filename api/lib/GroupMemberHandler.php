<?php
/**
 * Copyright (c) 2022 Emi Suarez All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";
 
 

class GroupMemberHandlerErrorTypes
{
    const ERR_ADD_USER = 1;
    const ERR_REMOVE_USER = 2;
    const ERR_GET_USER = 3;
    const ERR_GET_ALL_USER = 4;

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
        if( $user_id <= 0 || $user_id == null ||$user_id == "" || $group_id == null || $group_id == "" || $group_id <= 0)
        {
            throw new Exception("Invalid data", GroupMemberHandlerErrorTypes::ERR_ADD_USER);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_create_group_user_members`(:groupId, :userId)");
            $SQLStatement->bindParam(':groupId', $group_id);
            $SQLStatement->bindParam(':userId', $user_id);
            $SQLStatement->execute();
        } catch (PDOException $dbException) {
            throw new Exception("Error adding user", GroupMemberHandlerErrorTypes::ERR_ADD_USER);
        }
    }

    public function removeUser(int $group_id, int $user_id)
    {
        if( $user_id <= 0 || $user_id == null || $user_id == "" || $group_id == null || $group_id == ""|| $group_id <= 0)
        {
            throw new Exception("Invalid data", GroupMemberHandlerErrorTypes::ERR_REMOVE_USER);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_delete_group_user_members`(:groupId, :userId)");
            $SQLStatement->bindParam(':groupId', $group_id);
            $SQLStatement->bindParam(':userId', $user_id);
            $SQLStatement->execute();
        } catch(PDOException $dbException){
            throw new Exception("Error removing user", GroupMemberHandlerErrorTypes::ERR_REMOVE_USER);
        }

        
    }

    public function getUser(int $group_id, int $user_id)
    {
        if( $user_id <= 0 || $user_id == null || $user_id == ""|| $group_id == null|| $group_id == "" || $group_id <= 0)
        {
            throw new Exception("Invalid data", GroupMemberHandlerErrorTypes::ERR_GET_USER);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_get_group_user_members`(:groupId, :userId)");
            $SQLStatement->bindParam(':groupId', $group_id);
            $SQLStatement->bindParam(':userId', $user_id);
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $dbException){
            throw new Exception("Error getting user", GroupMemberHandlerErrorTypes::ERR_GET_USER);
        }  
        
    }

    public function getAllUsers()
    {
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_getAll_group_user_members`");
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $dbException){
            throw new Exception( "Error getting all users", GroupMemberHandlerErrorTypes::ERR_GET_ALL_USER);
        }
        
    }


 }
 ?>