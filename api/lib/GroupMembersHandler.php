<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

 include_once "./DatabaseConnection.php";

 class GroupMemberHandler
 {
    private $connection;

    public function __construct()
    {
        $connection = (new DataBaseConnection())->getInstance();
    }

    public function addUser(int $group_id, int $user_id)
    {
        
    }

    public function removeUser(int $group_id, int $user_id)
    {
        
    }

    public function getUser(int $group_id, int $user_id)
    {
       
    }

    public function getAllUsers(int $group_id)
    {
        
    }

 }
 ?>