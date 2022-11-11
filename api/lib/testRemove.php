<?php 

include_once "./UserHandler.php";

// Aquí instanciamos un objeto de la clase UserHandler para luego correrle la función create con datos falopa.

$instancia = new UserHandler();
$instancia->remove(2);

?>