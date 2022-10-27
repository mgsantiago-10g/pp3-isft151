<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";

 class Accountant
 {
    private $connection;

    public function __construct()
    {
        $connection = (new DataBaseConnection())->getInstance();
    }

    public function create(int $user_id, string $action, $date)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_create_audit`(:userId, :action, :date)");
        $SQLStatement->bindParam(':userId', $user_id);
        $SQLStatement->bindParam(':action', $action);
        $SQLStatement->bindParam(':date', $date);
        $SQLStatement->execute();
    }

    public function get(int $user_id)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_get_audit`(:userId)");
        $SQLStatement->bindParam(':userId', $user_id);
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);
    }

    public function getAll()
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_getAll_audit`");
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);
       
    }

 }
 ?>