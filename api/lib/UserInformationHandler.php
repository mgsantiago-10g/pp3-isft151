<?php 

    include_once "./DatabaseConnection.php";

    class UserInformationHandler{
        private $connection;

        public function __construct(){
            $this->connection = (new DatabaseConnection())->getInstance();
        }

        public function create(int $user_id, string $name, string $surname, string $dni, string $email){
            $SQLStatement = $this->connection->prepare("CALL `usp_create_user_information`(:name, :description)");
            $SQLStatement->bindParam(':name', $name);
            $SQLStatement->bindParam(':description', $description);
            $SQLStatement->execute();
        }

        public function remove(int $user_information_id){
            $SQLStatement =$this->connection->prepare("CALL `usp_delete_user_information`(:id_user_information)");
            $SQLStatement->bindParam(':id_user_information', $user_information_id);
            $SQLStatement->execute();
        }
        
        public function update(int $user_id, string $name, string $surname, string $dni, string $email){
            $SQLStatement =$this->connection->prepare("CALL `usp_update_user_information`(:id_user_information, :name, :description)");
            $SQLStatement->bindParam(':id_user_information', $name);
            $SQLStatement->bindParam(':name', $description);
            $SQLStatement->bindParam(':description', $description);
            $SQLStatement->execute();
        }
        
        public function get(int $user_id){
            $SQLStatement =$this->connection->prepare("CALL `usp_get_user_information`(:id_user_information)");
            $SQLStatement->bindParam(':id_user_information', $user_information_id);
            $SQLStatement->execute();
        }
        
        public function getAll(){
            $SQLStatement =$this->connection->prepare("CALL `usp_getAll_user_information`()");
            $SQLStatement->execute();
        }

    };

?>