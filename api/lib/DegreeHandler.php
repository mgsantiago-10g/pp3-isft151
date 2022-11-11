<?php


include_once "./DatabaseConnection.php";

 class DegreeHandlerErrorTypes{
	const ERROR_INVALID_INPUT = 3;
	const ERROR_DB_CREATE_DEGREE = 31;
	const ERROR_DB_REMOVE_DEGREE = 32;
	const ERROR_DB_UPDATE_DEGREE = 33;
	const ERROR_DB_GET_DEGREE = 34;
	const ERROR_DB_GETALL_DEGREE = 35;
 };

class DegreeHandler
{
	private $connection;

	public function __construct()
    {
		$connection = (new DataBaseConnection())->getInstance();
	}
	
	public function create( string $name, string $description, string $resolution ) 
	{
		if( !($name && $description && $resolution) )
		{
			throw new Exception('Error: Missing parameter/s.',  DegreeHandlerErrorTypes::ERROR_INVALID_INPUT);
		}

		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_create_degree`(:name, :description, :resolution)");
			$SQLAuthStatement->bindParam(':name', $name);
			$SQLAuthStatement->bindParam(':description', $description);
			$SQLAuthStatement->bindParam(':resolution', $resolution);
			$SQLAuthStatement->execute();
		}
		catch(Exception $exception)
		{
			throw new Exception('Error: failed to create degree',  DegreeHandlerErrorTypes::ERROR_DB_CREATE_DEGREE);
		}
		
	}
	public function remove( int $degree_id ) 
	{
		if( !($degree_id && $degree_id > 0) )
		{
			throw new Exception('Error: Missing parameter/s.',  DegreeHandlerErrorTypes::ERROR_INVALID_INPUT);
		}

		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_delete_degree`(:id)");
			$SQLAuthStatement->bindParam(':id', $degree_id);
			$SQLAuthStatement->execute();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to delete degree',  DegreeHandlerErrorTypes::ERROR_DB_DELETE_DEGREE);
		}
		
	}

	public function update( int $degree_id, string $name, string $description, string $resolution )
	{
		if( !( ($name && $description && $resolution) && ($degree_id && $degree_id > 0) ) )
		{
			throw new Exception('Error: Missing parameter/s.',  DegreeHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_update_degree `(:id, :name, :description, :resolution)");
			$SQLAuthStatement->bindParam(':id', $degree_id);
			$SQLAuthStatement->bindParam(':name', $name);
			$SQLAuthStatement->bindParam(':description', $description);
			$SQLAuthStatement->bindParam(':resolution', $resolution);
			$SQLAuthStatement->execute();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to update degree',  DegreeHandlerErrorTypes::ERROR_DB_UPDATE_DEGREE);
		}
	}

	public function get( int $degree_id )
	{
		if( !($degree_id && $degree_id > 0) )
		{
			throw new Exception('Error: Missing parameter/s.',  DegreeHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
			try
			{
				$SQLAuthStatement = $this->connection->prepare("CALL `usp_get_degree`(:id)");
				$SQLAuthStatement->bindParam(':id', $degree_id);
				$SQLAuthStatement->execute();
				$response = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
				$SQLAuthStatement->closeCursor();
			}
			catch(Exception $e)
			{
				throw new Exception('Error: failed to get degree',  DegreeHandlerErrorTypes::ERROR_DB_GET_DEGREE);
			}

	}
	public function getAll() 
	{
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_getAll_degree`()");
			$SQLAuthStatement->execute();
			$response = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
			$SQLAuthStatement->closeCursor();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to create degree',  DegreeHandlerErrorTypes::ERROR_DB_GETALL_DEGREE);
		}
	}
	
	
};


?>
