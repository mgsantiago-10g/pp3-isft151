<?php

include_once "./lib/UserInformationHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $user_id = $input->user_id;

    if (gettype($user_id) != "integer") {
        throw new Exception("Invalid data type", 1);
    }

    $userInformationHandler = new UserInformationHandler();
    $userInformationHandler->delete($user_id);
    $status = array('status' => 'Ok', 'response' => 'Success');
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
