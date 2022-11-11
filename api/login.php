<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "./lib/AuthHandler.php";

try
{
    //Get Input Data
	$input = json_decode(file_get_contents('php://input'));
	$password = $input->password;
	$username = $input->username;
	
	//Check input conditions (patterns, sizes, conditions... )
    
    //Execute API Class Method/Procedure
    $authInstance = new AuthManager();
    $authInstance->login($username, $password);
    
    //Process output
    
    //Build Client Response
}
catch (Exception $connectionException)
{
    //Handle Possible Errors
    
    //Build Error Client Messages
}