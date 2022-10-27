<?php

$connection = null;

try
{
    $connection = new PDO('');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $connectionException) 
{
    
    die();
};

?>