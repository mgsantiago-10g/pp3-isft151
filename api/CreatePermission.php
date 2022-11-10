<?php

include_once "./lib/GroupPermissionsHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $groupId = $input->groupId;
    $actionId = $input->actionId;

    if (gettype($groupId) != "integer" || gettype($password) != "integer") {
        throw new Exception("Invalid data type", 1);
    }

    $groupPermissionsHandler = new GroupPermissionsHandler();
    $groupPermissionsHandler->addPermission($groupId, $actionId);
    $status = array('status' => 'Ok', 'response' => 'Success');
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
