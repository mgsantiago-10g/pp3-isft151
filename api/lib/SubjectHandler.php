<?php


include_once "./DatabaseConnection.php";

class SubjectHandlerErrorTypes{
	const ERROR_INVALID_INPUT = 2;
	const ERROR_DB_CREATE_SUBJECT = 21;
	const ERROR_DB_REMOVE_SUBJECT = 22;
	const ERROR_DB_UPDATE_SUBJECT = 23;
	const ERROR_DB_GET_SUBJECT = 24;
	const ERROR_DB_GETALL_SUBJECT = 25;
 };

class SubjectHandler
{
	private $connection;

	public function __construct()
    {
		$connection = (new DataBaseConnection())->getInstance();
	}
	
	public function create( string $name, $year )
	{
		if( !($name && $year))
		{
			throw new Exception('Error: Missing parameter/s.',  SubjectHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_create_subject`(:name, :year)");
			$SQLAuthStatement->bindParam(':name', $name);
			$SQLAuthStatement->bindParam(':year', $year);
			$SQLAuthStatement->execute();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to create subject',  SubjectHandlerErrorTypes::ERROR_DB_CREATE_SUBJECT);
		}
	}
	public function remove( int $subject_id ) 
	{
		if( !($subject_id && $subject_id > 0) )
		{
			throw new Exception('Error: Missing parameter/s.',  SubjectHandlerErrorTypes::ERROR_INVALID_INPUT);
		}	
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_delete_subject`(:id)");
			$SQLAuthStatement->bindParam(':id', $subject_id);
			$SQLAuthStatement->execute();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to delete subject',  SubjectHandlerErrorTypes::ERROR_DB_DELETE_SUBJECT);
		}
			
	}
	public function update( int $subject_id, string $name, $year ) 
	{
		if( !(  ($subject_id && $name && $year) && $subject_id > 0)  )
		{
			throw new Exception('Error: Missing parameter/s.',  SubjectHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_update_subject `(:id, :name, :year)");
			$SQLAuthStatement->bindParam(':id', $subject_id);
			$SQLAuthStatement->bindParam(':name', $name);
			$SQLAuthStatement->bindParam(':year', $year);
			$SQLAuthStatement->execute();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to update subject',  SubjectHandlerErrorTypes::ERROR_DB_UPDATE_SUBJECT);
		}
		
	}
	public function get( int $subject_id ) 
	{
		if( !($subject_id && $subject_id > 0))
		{
			throw new Exception('Error: Missing parameter/s.',  SubjectHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_get_subject`(:id)");
			$SQLAuthStatement->bindParam(':id', $subject_id);
			$SQLAuthStatement->execute();
			$response = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
			$SQLAuthStatement->closeCursor();
		
		}catch(Exception $e)
		{
			throw new Exception('Error: failed to get subject',  SubjectHandlerErrorTypes::ERROR_DB_GET_SUBJECT);
		}
	}
	public function getAll() 
	{
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_getAll_subject`()");
			$SQLAuthStatement->execute();
			$response = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
			$SQLAuthStatement->closeCursor();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to getAll subjects',  SubjectHandlerErrorTypes::ERROR_DB_GETALL_SUBJECT);
		}
	}
	
};


?>
