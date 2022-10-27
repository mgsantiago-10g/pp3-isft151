<?php 

    include_once "./DatabaseConnection.php";

    class ActionHandler{
        private $connection;

        public function __construct(){
            $this->connection = (new DatabaseConnection())->getInstance();
        }

        public function create(string $name, string $description){
            $SQLStatement =$this->connection->prepare("CALL `usp_create_action`(:name, :description)");
            $SQLStatement->bindParam(':name', $name);
            $SQLStatement->bindParam(':description', $description);
            $SQLStatement->execute();
        }

        public function remove(int $action_id){
            $SQLStatement =$this->connection->prepare("CALL `usp_delete_action`(:id_action)");
            $SQLStatement->bindParam(':id_action', $action_id);
            $SQLStatement->execute();
        }
        
        public function update(int $action_id, string $name, string $description){
            $SQLStatement =$this->connection->prepare("CALL `usp_update_action`(:id_action, :name, :description)");
            $SQLStatement->bindParam(':id_action', $name);
            $SQLStatement->bindParam(':name', $description);
            $SQLStatement->bindParam(':description', $description);
            $SQLStatement->execute();
        }
        
        public function get(int $action_id){
            $SQLStatement =$this->connection->prepare("CALL `usp_get_action`(:id_action)");
            $SQLStatement->bindParam(':id_action', $action_id);
            $SQLStatement->execute();
        }
        
        public function getAll(){
            $SQLStatement =$this->connection->prepare("CALL `usp_getAll_action`()");
            $SQLStatement->execute();
        }

    };

?>