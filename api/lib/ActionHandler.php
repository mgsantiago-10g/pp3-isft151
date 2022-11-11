<?php 

    include_once "./DatabaseConnection.php";

    class AuthHandlerErrorTypes
    {
        const ERR_INVALID_ACTION_DATA= 81;
        const ERR_INVALID_ACTION_ID= 82;
        const ERR_CREATE_ACTION= 83;
        const ERR_REMOVE_ACTION= 84;
        const ERR_UPDATE_ACTION= 85;
        const ERR_GET_ACTION= 86;
        const ERR_GET_ALL_ACTIONS= 87;
    }

    class ActionHandler{
        private $connection;

        public function __construct(){
            $this->connection = (new DatabaseConnection())->getInstance();
        }

        public function create(string $name, string $description){
            if (!is_null($name) && !empty($name) && !is_null($description) && !empty($description)) {
                throw new Exception("Error", UserHandlerErrorTypes::ERR_INVALID_ACTION_DATA);
            }

            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_create_action`(:name, :description)");
                $SQLStatement->bindParam(':name', $name);
                $SQLStatement->bindParam(':description', $description);
                $SQLStatement->execute();
            }catch(PDOException $dbException){
                throw new Exception('Error', UserHandlerErrorTypes::ERR_CREATE_ACTION);
            }

            return 'Success';
            
        }

        public function remove(int $action_id){
            if (!is_null($action_id) && $action_id > 0 ) {
                throw new Exception("Error", UserHandlerErrorTypes::ERR_INVALID_ACTION_ID);
            }

            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_delete_action`(:id_action)");
                $SQLStatement->bindParam(':id_action', $action_id);
                $SQLStatement->execute();
            }catch(PDOException $dbException){
                throw new Exception('Error', UserHandlerErrorTypes::ERR_REMOVE_ACTION);
            }
            
        }
        
        public function update(int $action_id, string $name, string $description){
            if (!is_null($name) && !empty($name) && !is_null($description) && !empty($description)) {
                throw new Exception("Error", UserHandlerErrorTypes::ERR_INVALID_ACTION_DATA);
            }
            
            if (!is_null($action_id) && $action_id > 0) {
                throw new Exception("Error", UserHandlerErrorTypes::ERR_INVALID_ACTION_ID);
            }

            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_update_action`(:id_action, :name, :description)");
                $SQLStatement->bindParam(':id_action', $name);
                $SQLStatement->bindParam(':name', $description);
                $SQLStatement->bindParam(':description', $description);
                $SQLStatement->execute();
            }catch(PDOException $dbException){
                throw new Exception('Error', UserHandlerErrorTypes::ERR_UPDATE_ACTION);
            }
        }
        
        public function get(int $action_id){
            if (!is_null($action_id) && $action_id > 0) {
                throw new Exception("Error", UserHandlerErrorTypes::ERR_INVALID_ACTION_ID);
            }

            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_get_action`(:id_action)");
                $SQLStatement->bindParam(':id_action', $action_id);
                $SQLStatement->execute();
                $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
                return $response;
            }catch(PDOException $dbException){
                throw new Exception('Error', UserHandlerErrorTypes::ERR_GET_ACTION);
            }
        }
        
        public function getAll(){
            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_getAll_action`()");
                $SQLStatement->execute();
                $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
                return $response;
            }catch(PDOException $dbException){
                throw new Exception('Error', UserHandlerErrorTypes::ERR_GET_ALL_ACTIONS);
            }
        }

    };

?>