<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "./DatabaseConnection.php";

class AuthHandler
{
	private $connection;
	
	public function __construct()
    {
		$connection = (new DatabaseConnection())->getInstance();
	}
	
	public function login( string $username, string $password ) : string
	{
		if ($username == "" || $password == "")
		{
			//to-do
			//$status = array("status" => "error", "description" => "inputs can't be empty!");
		} 
		else 
		{
			//Validate user existence
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_authenticate_user`(:username)");
			$SQLAuthStatement->bindParam(':username', $username);
			$SQLAuthStatement->execute();
			$response = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
			$SQLAuthStatement->closeCursor();
			
			if (sizeof($response) != 0) 
			{
				if (password_verify($password, $response[0]["password"]))
				{
					$id_user = $response[0]["id"];
					$token = hash("sha256", $username . $response[0]["password"]);
					//If valid, create token and establish session
					//toDo: take into account possible errors
					$SQLSessionStatement =$this->connection->prepare("CALL `usp_create_user_session`(:id_user, :token)");
					$SQLSessionStatement->bindParam(':id_user', $id_user);
					$SQLSessionStatement->bindParam(':token', $token);
					$SQLSessionStatement->execute();
					$SQLSessionStatement->closeCursor();
					//$status = array("status" => "ok", "responseData" => array("token" => $token));
				} 
				else 
				{
					//to-do
				}
			}
			else 
			{
				//to-do
			}
		}
		
		return $token;
	}
	
	public function logout( string $token )
	{
		if( $this->validateSession($token)) 
		{
			$SQLStatement = $this->connection->prepare("CALL `usp_delete_user_session`(:token)");
			$SQLStatement->bindParam(':token', $token);
			$SQLStatement->execute();
		}
		else
		{
			//to-do
		}
	}

	public function validateSession( string $token ) : bool
	{
		$tokenStatus = null;
		
		$SQLStatement = $this->connection->prepare("CALL `usp_check_session_token`(:token)");
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
