<?php

include_once "./lib/DegreeSubjectsHandler.php";

try
{
    $degreeSubjectsHandler = new DegreeSubjectsHandler();
    $degreeSubjectsHandler->getAllSubjects($degreeId, $subjectId);
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