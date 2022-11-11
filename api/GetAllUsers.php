<?php

include_once "./lib/UserHandler.php";

try
{
    $userHandler = new UserHandler();
    $response = $userHandler->getAll();
    $status = array('status' => 'Ok', 'response' => $response);
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
