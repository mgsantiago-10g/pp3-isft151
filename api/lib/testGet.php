<?php 

include_once "./UserHandler.php";

// Aquí instanciamos un objeto de la clase UserHandler para luego correrle la función create con datos falopa.

$instancia = new UserHandler();
$datos = $instancia->get(4);
echo "<br>Devuelve...<br>Usuario: <strong>".$datos[0]['username']."</strong>";

?>