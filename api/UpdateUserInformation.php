<?php

include_once "./lib/UserInformationHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $user_id = $input->user_id;
    $name = $input->name;
    $surname = $input->surname;
    $dni = $input->dni;
    $email = $input->email;

    if (gettype($user_id) != "integer" || gettype($name) != "string" || gettype($surname) != "string" || gettype($dni) != "string" || gettype($email) != "string") {
        throw new Exception("Invalid data type", 1);
    }

    $userInformationHandler = new UserInformationHandler();
    $userInformationHandler->update($user_id, $name, $surname, $dni, $email);
    $status = array('status' => 'Ok', 'response' => 'Success');
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
