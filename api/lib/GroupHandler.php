<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";

 class GroupHandler
 {
    private $connection;

    public function __construct()
    {
        $connection = (new DataBaseConnection())->getInstance();
    }

    public function create ( string $name, string $description)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_create_group`(:name, :description)");
        $SQLStatement->bindParam(':name', $name);
        $SQLStatement->bindParam(':description', $description);
        $SQLStatement->execute();
    }

    public function remove ( int $group_id)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_delete_group`(:groupId)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->execute();
    }

    public function update (int $group_id, string $name, string $description)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_update_group`(:groupId, :name, :description)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->bindParam(':name', $name);
        $SQLStatement->bindParam(':description', $description);
        $SQLStatement->execute();
    }

    public function get ( int $group_id)
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_get_group`(:groupId)");
        $SQLStatement->bindParam(':groupId', $group_id);
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);
    }

    public function getAll()
    {
        $SQLStatement = $this->connection->prepare("CALL `usp_getAll_group`");
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($response);

    }
    
 }
 
?>
