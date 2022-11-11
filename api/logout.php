<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "./lib/AuthHandler.php";

$input = json_decode(file_get_contents('php://input'));

$password = $input->password;
$username = $input->username;

try
{
    //to-do (Execute login function with username/password parameters)
}
catch (Exception $connectionException)
{
    //to-do
}
