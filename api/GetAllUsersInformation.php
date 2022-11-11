<?php

include_once "./lib/UserInformationHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);

    $userInformationHandler = new UserInformationHandler();
    $response = $userInformationHandler->getAll();
    $status = array('status' => 'Ok', 'response' => $response);
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
