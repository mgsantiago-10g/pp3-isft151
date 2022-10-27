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
        
    }

    public function get(int $user_id)
    {
        
    }

    public function getAll()
    {
       
    }

 }
 ?>