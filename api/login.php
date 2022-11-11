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
	$input = json_decode(file_get_contents('php://input'));
	$password = $input->password;
	$username = $input->username;
	
	if (gettype($password) != "string" || gettype($username) != "string" || is_null($username) || empty($username) || is_null($password) || empty($password)) {
        throw new Exception("Invalid username and/or password", 1);
    }
    
    $authInstance = new AuthManager();
    $response = $authInstance->login($username, $password);
    
    echo json_encode($response);
}catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}