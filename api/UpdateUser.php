<?php

include_once "./lib/UserHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $userId = $input->userId;
    $username = $input->username;
    $password = $input->password;

    if (gettype($username) != "string" || gettype($password) != "string" || gettype($userId) != "integer") {
        throw new Exception("Invalid data type", 1);
    }

    $userHandler = new UserHandler();
    $userHandler->update($userId, $username, $password);
    $status = array('status' => 'Ok', 'response' => 'Success');
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
