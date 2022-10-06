<?php

$connection = null;

try
{
    $connection = new PDO('mysql:host=127.0.0.1:3306;dbname=application-template', 'root', 'isft151' );
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $connectionException) 
{
    //Contestamos al cliente que su petición no se puede efectuar por un problema
   // $status = array( status=>'db-error', description=>$connectionException->getMessage() );
    //echo json_encode($status);

    //Cortamos la ejecución del programa del servidor de forma forzada
    die();
};

?>