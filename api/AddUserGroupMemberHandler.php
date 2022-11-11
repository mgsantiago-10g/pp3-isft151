<?php
/**
 * Copyright (c) 2022 Emi Suarez All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "../lib/GroupMemberHandler.php";

class AddUserToGroupErrorType
{
    const ERR_INVALID_DATA = 1;
}

try
{
    //Get Input Data
    $input = json_decode(file_get_contents('php://input'));
    $group_id = $input->group_id;
    $user_id = $input->user_id;
    

    //Check input conditions (patterns, sizes, conditions... )
    if(gettype($user_id)!= 'integer' || gettype($group_id)!= 'integer' )
    {
        throw new Exception("Invalid data type",AddUserToGroupErrorType::ERR_INVALID_DATA);
    }
    
    //Execute API Class Method/Procedure
    $groupMemberHandler = new GroupMemberHandler();
    $groupMemberHandler->addUser($group_id, $user_id);
    //build client response
    $status = array( 'status'=>'ok ', 'response'=>'Success' );
    echo json_encode($status);
    
} catch(Exception $Exception){
    throw new Exception("Error Invalid data type", AddUserToGroupErrorType::ERR_INVALID_DATA);
    
    $status = array( 'status'=>'ERROR', 'response'=>'Error invalid data type');
    echo json_encode($status);
} catch (JsonException $jsonException) {
    $status = array('status' => 'Error', 'response' => 'Error invalid request format');
    echo json_encode($status);
}
?>