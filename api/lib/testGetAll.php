<?php 

include_once "./UserHandler.php";

// Aquí instanciamos un objeto de la clase UserHandler para luego correrle la función create con datos falopa.

$instancia = new UserHandler();
$datos = $instancia->getAll();
for ($i=0; $i < count($datos); $i++){
	echo "<br>Devuelve...<br>Usuario: <strong>".$datos[$i]['username']."</strong>";
}

?>