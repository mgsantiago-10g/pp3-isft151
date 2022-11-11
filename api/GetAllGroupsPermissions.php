<?php

include_once "./lib/GroupPermissionsHandler.php";

try
{
    $groupPermissionsHandler = new GroupPermissionsHandler();
    $response = $groupPermissionsHandler->getPermissions();
    $status = array('status' => 'Ok', 'response' => $response);
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
