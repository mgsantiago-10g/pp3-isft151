<?php
/**
 * Copyright (c) 2022 Thiago Cabrera All rights reserved.
 * Contact: thiagofcabrera00@gmail.com
 * Released under the GPLv3
 * https://www.gnu.org/licenses/gpl-3.0
 **/

include_once "./DatabaseConnection.php";

class AuthHandlerErrorTypes
{
	const ERR_INVALID_USER_PASSWORD = 15;
	const ERR_INVALID_USER_DATA= 73;
	const ERR_INVALID_TOKEN= 88;
	const ERR_LOGIN= 89;
	const ERR_LOGOUT= 90;
	const ERR_VALIDATE_TOKEN= 91;
	const ERR_EXISTENT_TOKEN = 92;
	const ERR_NO_USER_FOUND = 93;
}

class AuthHandler
{
	private $connection;
	
	public function __construct()
    {
		$connection = (new DatabaseConnection())->getInstance();
	}
	
	public function login( string $username, string $password ) : string
	{
		if (!is_null($username) && !empty($username) && !is_null($password) && !empty($password))
		{
			throw new Exception('Error', AuthHandlerErrorTypes::ERR_INVALID_USER_DATA);
		} 
		
		try{
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
					try{
						$SQLSessionStatement =$this->connection->prepare("CALL `usp_create_user_session`(:id_user, :token)");
						$SQLSessionStatement->bindParam(':id_user', $id_user);
						$SQLSessionStatement->bindParam(':token', $token);
						$SQLSessionStatement->execute();
						$SQLSessionStatement->closeCursor();
						$status = array("status" => "ok", "response" => array("token" => $token));
						return $status;
					}catch(PDOException $dbException){
						throw new Exception("Error", AuthHandlerErrorTypes::ERR_EXISTENT_TOKEN);
					}
				} 
				else 
				{
					throw new Exception("Invalid user and/or password", AuthHandlerErrorTypes::ERR_INVALID_USER_PASSWORD)
				}
			}
			else 
			{
				throw new Exception("Error", AuthHandlerErrorTypes::ERR_NO_USER_FOUND);
			}
		}catch(PDOException $dbException){
			throw new Exception("Error", AuthHandlerErrorTypes::ERR_LOGIN);
		}
	}
	
	public function logout( string $token )
	{
		if(!is_null($token) && !empty($token)){
			throw new Exception("Error", AuthHandlerErrorTypes::ERR_INVALID_TOKEN);
		}

		if( $this->validateSession($token)) 
		{
			try{
				$SQLStatement = $this->connection->prepare("CALL `usp_delete_user_session`(:token)");
				$SQLStatement->bindParam(':token', $token);
				$SQLStatement->execute();
			}catch(PDOException $dbException){
				throw new Exception("Error", AuthHandlerErrorTypes::ERR_LOGOUT);
			}
		}
		else
		{
			throw new Exception("Error", AuthHandlerErrorTypes::ERR_INVALID_TOKEN);
		}
	}

	public function validateSession( string $token ) : bool
	{
		$tokenStatus = null;

		if(!is_null($token) && !empty($token)){
			throw new Exception("Error", AuthHandlerErrorTypes::ERR_INVALID_TOKEN);
		}
		
		try{
			$SQLStatement = $this->connection->prepare("CALL `usp_check_session_token`(:token)");
			$SQLStatement->bindParam(':token',  $token );
			$SQLStatement->execute();
			$response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $dbException){
			throw new Exception("Error", AuthHandlerErrorTypes::ERR_VALIDATE_TOKEN);			
		}
        
        if (sizeof($response) != 0)
        {
            $tokenStatus = true;
        }
        
        return $tokenStatus;
	}
}


?>
