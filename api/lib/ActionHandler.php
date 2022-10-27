<?php 

    include_once "./DatabaseConnection.php";

    class ActionHandler{
        private $connection;

        public function __construct(){
            $this->connection = (new DatabaseConnection())->getInstance();
        }

        public function create(string $name, string $description){
            #create action
        }

        public function remove(int $action_id){
            #remove action
        }
        
        public function update(int $action_id, string $name, string $description){
            #update action
        }
        
        public function get(int $action_id){
            #get action
        }
        
        public function getAll(){
            #get all actions
        }

    };

?>