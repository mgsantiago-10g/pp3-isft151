<?php

include_once "./lib/SubjectHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $name = $input->name;
    $description = $input->year;

    if (gettype($name) != "string" || gettype($year) != "string")  {
        throw new Exception("Invalid data type", 1);
    }

    $subjectHandler = new SubjectHandler();
    $subjectHandler->create($name, $year);
    $status = array('status' => 'Ok', 'response' => 'Success');
    echo json_encode($status);

} catch (Exception $connectionException) {
    $status = array('status' => 'Error', 'response' => 'Error processing request');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}

?>