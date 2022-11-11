<?php

include_once "./lib/ActionHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $description = $input->description;
    $name = $input->name;

    if (gettype($user_id) != "string" || gettype($name) != "string") {
        throw new Exception("Invalid data type", 1);
    }

    $actionHandler = new ActionHandler();
    $actionHandler->create($name, $description);
    $status = array('status' => 'Ok', 'response' => 'Success');
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
