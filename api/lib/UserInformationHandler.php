<?php 

    include_once "./DatabaseConnection.php";

    class UserInformationHandler{
        private $connection;

        public function __construct(){
            $this->connection = (new DatabaseConnection())->getInstance();
        }

        public function create(int $user_id, string $name, string $surname, string $dni, string $email){
            #create user info
        }

        public function remove(int $action_id){
            #remove user info
        }
        
        public function update(int $user_id, string $name, string $surname, string $dni, string $email){
            #update user info
        }
        
        public function get(int $user_id){
            #get user info
        }
        
        public function getAll(){
            #get all actions
        }

    };

?>