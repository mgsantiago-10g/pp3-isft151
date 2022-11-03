<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";

class AccountantErrorTypes
{
    const ERR_INVALID_INPUT_DATA = 1;
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
        if( $user_id <= 0 || $user_id == null || $action == null)
        {
            throw new Exception("Datos no válidos", AccountantErrorTypes::ERR_INVALID_INPUT_DATA);
        }
        //chequear el parametro date      
        $SQLStatement = $this->connection->prepare("CALL `usp_create_audit`(:userId, :action");//:date)");
        $SQLStatement->bindParam(':userId', $user_id);
        $SQLStatement->bindParam(':action', $action);
        //$SQLStatement->bindParam(':date', $date);
        $SQLStatement->execute();
                
    }

    public function get(int $user_id)
    {
        if ($user_id <= 0 || $user_id == null)
        {
            throw new Exception("Dato no válido", AccountantErrorTypes :: ERR_INVALID_INPUT_DATA);
        }
        $SQLStatement = $this->connection->prepare("CALL `usp_get_audit`(:userId)");
        $SQLStatement->bindParam(':userId', $user_id);
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function getAll()
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_getAll_audit`");
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        
       
    }

 }
 ?>