<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "./database.php";

class AuthManager
{
	private $connection;
	
	public function __construct()
    {
		$this->connection = (new DatabaseConnection())->getInstance();
	}
	
	public function login( string $username, string $password ) : string
	{
		if ($username == "" || $password == "")
		{
			//to-do
			$status = array("status" => "error", "description" => "inputs can't be empty!");
			echo json_encode($status);
		} 
		else 
		{
			//Validate user existence
			$SQLAuthStatement = $this->connection->prepare("CALL `usp-authenticate-user`(:username)");
			$SQLAuthStatement->bindParam(':username', $username);
			$SQLAuthStatement->execute();
			$response_db = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
			$SQLAuthStatement->closeCursor();
			
			
			if (count($response_db) != 0) 
			{
				
				if (password_verify($password, $response_db[0]["password"]))
				{
					$id_user = $response_db[0]["id"];
					$token = hash("sha256", $username . $response_db[0]["password"]);
					//If valid, create token and establish session
					//toDo: take into account possible errors
					$SQLSessionStatement =$this->connection->prepare("CALL `usp-create-user-session`(:id_user, :token)");
					$SQLSessionStatement->bindParam(':id_user', $id_user);
					$SQLSessionStatement->bindParam(':token', $token);
					$SQLSessionStatement->execute();
					$SQLSessionStatement->closeCursor();
					//$status = array("status" => "ok", "responseData" => array("token" => $token));
					$this->response_client = ["status" => "Ok", "response" => $token];
				} 
				else 
				{
					//to-do
					$this->response_client = [ "status" => "ERROR", "description" => 'Usuario y/o Contraseña errónea'];
				}
				echo json_encode($this->response_client);
			}
			else 
			{
				//to-do
				$this->response_client = [ "status" => "ERROR", "description" => 'Error'];
			}
			echo json_encode($this->response_client);
		}
		
		return $token;
	}
	
	public function logout( string $token )
	{
		if( $this->validateSession($token)) 
		{
			$SQLStatement = $this->connection->prepare("CALL `usp-delete-user-session`(:token)");
			$SQLStatement->bindParam(':token', $token);
			$SQLStatement->execute();
		}
		else
		{
			//to-do
			$this->response_client = [ "status" => "ERROR", "description" => 'Sorry! Something wrong happend'];
		}
		echo json_encode($this->reasponse_client);

	}

	public function validateSession( string $token ) : bool
	{
		$tokenStatus = null;
		
		$SQLStatement = $this->connection->prepare("CALL `usp-check-session-token`(:token)");
        $SQLStatement->bindParam(':token',  $token );
        $SQLStatement->execute();
        $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
        
        if (sizeof($response) != 0)
        {
            $tokenStatus = true;
        }
        
        return $tokenStatus;
	}
}


?>
