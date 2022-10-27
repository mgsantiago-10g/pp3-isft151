<?php


include_once "./DatabaseConnection.php";

class SubjectHandler
{
	private $connection;

	public function __construct()
    {
		$connection = (new DataBaseConnection())->getInstance();
	}
	
	public function addSubject( int $degree_id, int $subject_id ) 
	{
		/*
			$SQLAuthStatement = $connection->prepare("CALL `usp_create_degree_subjects`(:degree_id, :subject_id)");
			$SQLAuthStatement->bindParam(':degree_id', $degree_id);
			$SQLAuthStatement->bindParam(':subject_id', $subject_id);
			$SQLAuthStatement->execute();
		*/
	}

	public function removeSubject( int $degree_id, int $subject_id ) 
	{
		/*
			$SQLAuthStatement = $connection->prepare("CALL `usp_delete_degree_subjects`(:degree_id, :subject_id)");
			$SQLAuthStatement->bindParam(':degree_id', $degree_id);
			$SQLAuthStatement->bindParam(':subject_id', $subject_id);
			$SQLAuthStatement->execute();
		*/
	}

	public function getSubject( int $degree_id, int $subject_id ) 
	{
		/*
			$SQLAuthStatement = $connection->prepare("CALL `usp_get_degree_subjects`(:degree_id, :subject_id)");
			$SQLAuthStatement->bindParam(':degree_id', $degree_id);
			$SQLAuthStatement->bindParam(':subject_id', $subject_id);
			$SQLAuthStatement->execute();
			$SQLAuthStatement->closeCursor();
		*/
	}
	public function getAllSubjects() 
	{
		/*
			$SQLAuthStatement = $connection->prepare("CALL `usp_getAll_degree_subjects`()");
			$SQLAuthStatement->execute();
			$SQLAuthStatement->closeCursor();
		*/
	}
	
	
};


?>
