<?php


include_once "./DatabaseConnection.php";

class DegreeHandler
{
	private $connection;

	public function __construct()
    {
		$connection = (new DataBaseConnection())->getInstance();
	}
	
	public function create( string $name, string $description, string $resolution ) 
	{
		
		$SQLAuthStatement = $connection->prepare("CALL `usp_create_degree`(:name, :description, :resolution)");
		$SQLAuthStatement->bindParam(':name', $name);
		$SQLAuthStatement->bindParam(':description', $description);
		$SQLAuthStatement->bindParam(':resolution', $resolution);
		$SQLAuthStatement->execute();
		
	}
	public function remove( int $degree_id ) 
	{
			
		$SQLAuthStatement = $connection->prepare("CALL `usp_delete_degree`(:id)");
		$SQLAuthStatement->bindParam(':id', $degree_id);
		$SQLAuthStatement->execute();
		
	}
	public function update( int $degree_id, string $name, string $description, string $resolution )
	{
		
		$SQLAuthStatement = $connection->prepare("CALL `usp_update_degree `(:id, :name, :description, :resolution)");
		$SQLAuthStatement->bindParam(':id', $degree_id);
		$SQLAuthStatement->bindParam(':name', $name);
		$SQLAuthStatement->bindParam(':description', $description);
		$SQLAuthStatement->bindParam(':resolution', $resolution);
		$SQLAuthStatement->execute();
		
	}
	public function get( int $degree_id )
	{
		
		$SQLAuthStatement = $connection->prepare("CALL `usp_get_degree`(:id)");
		$SQLAuthStatement->bindParam(':id', $degree_id);
		$SQLAuthStatement->execute();
		$SQLAuthStatement->closeCursor();
		
	}
	public function getAll() 
	{
		
		$SQLAuthStatement = $connection->prepare("CALL `usp_getAll_degree`()");
		$SQLAuthStatement->execute();
		$SQLAuthStatement->closeCursor();
		
	}
	
	
};


?>
