<?php
/**
 * Copyright (c) 2022 Emi Suarez All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";

class AccountantErrorTypes
{
    const ERR_CREATE_ACCOUNTANT= 1;
    const ERR_INVALID_ENTITY_ID = 2;
    const ERR_GET_ACCOUNTANT = 3;
    const ERR_GET_ALL_ACCOUNTANTS = 4;
}

 class Accountant
 {
    private $connection;

    public function __construct()
    {
        $connection = (new DataBaseConnection())->getInstance();
    }

    //Revisar el parametro date. Eventu
    public function create(int $user_id, string $action)//$date
    {
        if( $user_id <= 0 || $user_id == "" || $action == "")
        {
            throw new Exception("Invalid data", AccountantErrorTypes::ERR_CREATE_ACCOUNTANT);
        }
        try{
            //chequear el parametro date      
            $SQLStatement = $this->connection->prepare("CALL `usp_create_audit`(:userId, :action");//:date)");
            $SQLStatement->bindParam(':userId', $user_id);
            $SQLStatement->bindParam(':action', $action);
            //$SQLStatement->bindParam(':date', $date);
            $SQLStatement->execute();
        } catch(PDOException $dbException){
            throw new Exception("Error data", AccountantErrorTypes::ERR_CREATE_ACCOUNTANT);
        }
                
    }

    public function get(int $user_id)
    {
        if ($user_id <= 0 || $user_id == null)
        {
            throw new Exception("Invalid ID", AccountantErrorTypes :: ERR_GET_ACCOUNTANT);
        }
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_get_audit`(:userId)");
            $SQLStatement->bindParam(':userId', $user_id);
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $dbException) {
            throw new Exception("Invalid ID", AccountantErrorTypes::ERR_GET_ACCOUNTANT);
        }    
    }

    public function getAll()
    {
        try{
            $SQLStatement = $this->connection->prepare("CALL `usp_getAll_audit`");
            $SQLStatement->execute();
            $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $dbException){
            throw new Exception("Error gatting all accountants", AccountantErrorTypes::ERR_GET_ALL_ACCOUNTANTS);
        }
       
    }

 }


    /*$handler = new Accountant();
    try {
        $handler->create(1, 'hola');//works
        $handler->get(1); //works
        var_dump($handler->get(2)); //works
        var_dump($handler->getAll()); //works
    } catch (Exception $queryException) {
        echo ($queryException->getMessage());
    }*/
 ?>