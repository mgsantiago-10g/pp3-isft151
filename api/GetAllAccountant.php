<?php
/**
 * Copyright (c) 2022 Emi Suarez All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "../lib/Accountant.php";

try
{     
    //Execute API Class Method/Procedure
    $accountant = new Accountant();
    $response= $accountant->getAll();
    //build client response
    $status = array( 'status'=>'ok ', 'response'=>$response );
    echo json_encode($status);
    
    //falta catch de validacion de json.
} catch(Exception $Exception){
    throw new Exception("Error", 1);
    
    $status = array( 'status'=>'ERROR', 'response'=>'Error');
    echo json_encode($status);
}

 
?>