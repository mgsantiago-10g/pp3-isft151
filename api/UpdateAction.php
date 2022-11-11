<?php

include_once "./lib/ActionHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $action_id = $input->action_id;
    $name = $input->name;
    $description = $input->description;

    if (gettype($action_id) != "integer" || gettype($name) != "string" || gettype($description) != "string") {
        throw new Exception("Invalid data type", 1);
    }

    $actionHandler = new ActionHandler();
    $actionHandler->update($action_id, $name, $description);
    $status = array('status' => 'Ok', 'response' => 'Success');
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
