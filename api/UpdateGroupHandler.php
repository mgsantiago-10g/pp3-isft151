<?php
/**
 * Copyright (c) 2022 Emi Suarez All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "../lib/GroupHandler.php";

class UpdateGroupHandlerErrorType
{
    const ERR_INVALID_DATA = 1;
}

try
{
    //Get Input Data
    $input = json_decode(file_get_contents('php://input'));
    $group_id = $input->group_id;
    $name = $input->name;
    $description = $input->description;

    //Check input conditions (patterns, sizes, conditions... )
    if(gettype($group_id)!= 'integer' || gettype($name)!= 'string' || gettype($description)!= 'string')
    {
        throw new Exception("Invalid data type",UpdateGroupHandlerErrorType::ERR_INVALID_DATA);
    }
    
    //Execute API Class Method/Procedure
    $groupHandler = new GroupHandler();
    $groupHandler->remove($group_id, $name, $description);
    //build client response
    $status = array( 'status'=>'ok ', 'response'=>'Success' );
    echo json_encode($status);
    
    //falta catch de validacion de json.
} catch(Exception $Exception){
    throw new Exception("Error Invalid data type", UpdateGroupHandlerErrorType::ERR_INVALID_DATA);
    
    $status = array( 'status'=>'ERROR', 'response'=>'Error invalid data type');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
?>