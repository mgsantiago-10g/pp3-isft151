<?php


include_once "./DatabaseConnection.php";

class SubjectHandler
{
	private $connection;

	public function __construct()
    {
		$connection = (new DataBaseConnection())->getInstance();
	}
	
	public function create( string $name, $year ) : string
	{
		/*
			$SQLAuthStatement = $connection->prepare("CALL `usp_create_subject`(:name, :year)");
			$SQLAuthStatement->bindParam(':name', $name);
			$SQLAuthStatement->bindParam(':year', $year);
			$SQLAuthStatement->execute();
			$SQLAuthStatement->closeCursor();
		*/
	}
	public function remove( int $subject_id ) 
	{
		/*
			$SQLAuthStatement = $connection->prepare("CALL `usp_delete_subject`(:id)");
			$SQLAuthStatement->bindParam(':id', $subject_id);
			$SQLAuthStatement->execute();
			$SQLAuthStatement->closeCursor();
		*/
	}
	public function update( int $subject_id, string $name, $year ) 
	{
		/*	
			$SQLAuthStatement = $connection->prepare("CALL `usp_update_subject `(:id, :name, :year)");
			$SQLAuthStatement->bindParam(':id', $subject_id);
			$SQLAuthStatement->bindParam(':name', $name);
			$SQLAuthStatement->bindParam(':year', $year);
			$SQLAuthStatement->execute();
			$SQLAuthStatement->closeCursor();
		*/
	}
	public function get( int $subject_id ) 
	{
		/*
			$SQLAuthStatement = $connection->prepare("CALL `usp_get_subject`(:id)");
			$SQLAuthStatement->bindParam(':id', $subject_id);
			$SQLAuthStatement->execute();
			$SQLAuthStatement->closeCursor();
		*/
	}
	public function getAll() 
	{
		/*	
			$SQLAuthStatement = $connection->prepare("CALL `usp_getAll_subject`()");
			$SQLAuthStatement->execute();
			$SQLAuthStatement->closeCursor();
		*/
	}
	
	
};


?>
