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
        # $connection = (new DataBaseConnection())->getInstance();
    }

    public function create ( string $name, string $description)
    {

    }

    public function remove ( int $group_id)
    {

    }

    public function update (int $group_id, string $name, string $description)
    {

    }

    public function get ( int $group_id)
    {

    }

    public function getAll()
    {

    }
    
 }
 
?>
