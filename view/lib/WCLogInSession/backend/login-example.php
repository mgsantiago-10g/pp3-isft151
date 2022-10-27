<?php

include_once( "./database.php");

$json_body = file_get_contents('php://input');
$object = json_decode($json_body);

$password = $object->password;
$username = $object->username;

function createUserSession( $id_user )
{
	$token = hash('sha256', $username.$password);

	$SQLStatement = $connection->prepare("CALL `create_user_session`(:id_user, :token)");
	$SQLStatement->bindParam( ':id_user', $id_user );
	$SQLStatement->bindParam( ':token', $token );
	$SQLStatement->execute();

	return $token;
}

try
{
	$SQLStatement = $connection->prepare("CALL `auth_user`(:username, :password)");
	$SQLStatement->bindParam( ':username', $username );
	$SQLStatement->bindParam( ':password', $password );
	$SQLStatement->execute();

	
	$db_response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
	$SQLStatement->closeCursor();

	$response_client = null;

	if ( count($db_response) != 0 )
	{
		$id_user = $db_response[0]["id"];

		$token = hash('sha256', $username.$password);

		$SQLStatement2 = $connection->prepare("CALL `create_user_session`(:id_user, :token)");
		$SQLStatement2->bindParam( ':id_user', $id_user );
		$SQLStatement2->bindParam( ':token', $token );
		$SQLStatement2->execute();
		$SQLStatement2->closeCursor();

		$response_client = [ "status" => "OK", "response" => $token ];
	}
	else
	{
		
		$response_client = [ "status" => "ERROR", "description" => 'Usuario y/o Contraseña errónea'];
	}

	echo json_encode($response_client);
}
catch( PDOException $connectionException )
{
    $status = array( 'status'=>'db-error ', 'description'=>$connectionException->getMessage() );
    echo json_encode($status);
    die();
}

?>