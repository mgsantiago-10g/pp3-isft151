<?php

include_once "./lib/DegreeSubjectsHandler.php";

try
{
    $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $degreeId = $input->degreeId;
    $subjectId = $input->subjectId;

    if (gettype($degreeId) != "integer" || gettype($subjectId) != "integer") {
        throw new Exception("Invalid data type", 1);
    }

    $degreeSubjectsHandler = new DegreeSubjectsHandler();
    $degreeSubjectsHandler->getSubject($degreeId, $subjectId);
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