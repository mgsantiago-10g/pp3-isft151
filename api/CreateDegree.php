<?php

include_once "./lib/DegreeHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $name = $input->name;
    $description = $input->description;
    $resolution = $input->resolution;

    if (gettype($name) != "string" || gettype($description) != "string" || gettype($resolution) != "string") {
        throw new Exception("Invalid data type", 1);
    }

    $degreeHandler = new DegreeHandler();
    $degreeHandler->create($name, $description, $resolution);
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