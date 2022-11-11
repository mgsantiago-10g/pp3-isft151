<?php


include_once "./DatabaseConnection.php";


class DegreeSubjectsHandlerErrorTypes{
	const ERROR_INVALID_INPUT = 1;
	const ERROR_DB_CREATE_DEGREESUBJECTS = 11;
	const ERROR_DB_REMOVE_DEGREESUBJECTS = 12;
	const ERROR_DB_UPDATE_DEGREESUBJECTS = 13;
	const ERROR_DB_GET_DEGREESUBJECTS = 14;
	const ERROR_DB_GETALL_DEGREESUBJECTS = 15;
 };

class SubjectHandler
{
	private $connection;

	public function __construct()
    {
		$connection = (new DataBaseConnection())->getInstance();
	}
	
	public function addSubject( int $degree_id, int $subject_id ) 
	{
		if( !(  ($degree_id && $subject_id) && ($degree_id > 0 && $subject_id > 0) ) )
		{
			throw new Exception('Error: Missing parameter/s.',  DegreeSubjectsHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_create_degree_subjects`(:degree_id, :subject_id)");
			$SQLAuthStatement->bindParam(':degree_id', $degree_id);
			$SQLAuthStatement->bindParam(':subject_id', $subject_id);
			$SQLAuthStatement->execute();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to create degreeSubjects',  DegreeSubjectsHandlerErrorTypes::ERROR_DB_CREATE_DEGREESUBJECTS);
		}
	}

	public function removeSubject( int $degree_id, int $subject_id ) 
	{
		if( !(  ($degree_id && $subject_id) && ($degree_id > 0 && $subject_id > 0) ))
		{
			throw new Exception('Error: Missing parameter/s.',  DegreeSubjectsHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_delete_degree_subjects`(:degree_id, :subject_id)");
			$SQLAuthStatement->bindParam(':degree_id', $degree_id);
			$SQLAuthStatement->bindParam(':subject_id', $subject_id);
			$SQLAuthStatement->execute();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to remove degreeSubjects',  DegreeSubjectsHandlerErrorTypes::ERROR_DB_REMOVE_DEGREESUBJECTS);
		}
	}

	public function getSubject( int $degree_id, int $subject_id ) 
	{
		if( !( ($degree_id && $subject_id) && ($degree_id > 0 && $subject_id > 0)) )
		{
			throw new Exception('Error: Missing parameter/s.',  DegreeSubjectsHandlerErrorTypes::ERROR_INVALID_INPUT);
		}
		try
		{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_get_degree_subjects`(:degree_id, :subject_id)");
			$SQLAuthStatement->bindParam(':degree_id', $degree_id);
			$SQLAuthStatement->bindParam(':subject_id', $subject_id);
			$SQLAuthStatement->execute();
			$response = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
			$SQLAuthStatement->closeCursor();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to get degreeSubjects',  DegreeSubjectsHandlerErrorTypes::ERROR_DB_GET_DEGREESUBJECTS);
		}	
	}
	public function getAllSubjects() 
	{
		try{
			$SQLAuthStatement = $this->connection->prepare("CALL `usp_getAll_degree_subjects`()");
			$SQLAuthStatement->execute();
			$response = $SQLAuthStatement->fetchAll(PDO::FETCH_ASSOC);
			$SQLAuthStatement->closeCursor();
		}
		catch(Exception $e)
		{
			throw new Exception('Error: failed to getAll degreeSubjects',  DegreeSubjectsHandlerErrorTypes::ERROR_DB_GETALL_DEGREESUBJECTS);
		}
	}
};


?>
