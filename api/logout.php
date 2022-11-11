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
	$token = $input->token;
	
	if (gettype($token) != "string" || is_null($token) || empty($token)) {
        throw new Exception("Invalid username and/or password", 1);
    }
    
    $authInstance = new AuthManager();
    $authInstance->logout($token);
    
    $response = array('status' => 'ok', 'response' => 'Success');

    echo json_encode($response);
}catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}