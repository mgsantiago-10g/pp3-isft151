<?php

include_once "./lib/UserHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $userId = $input->userId;
    
    if (gettype($userId) != "integer") {
        throw new Exception("Invalid data type", 1);
    }

    $userHandler = new UserHandler();
    $response = $userHandler->get($userId);
    $status = array('status' => 'Ok', 'response' => $response);
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
