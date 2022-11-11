<?php 

    include_once "./DatabaseConnection.php";

    class UserInformationHandlerErrorTypes
    {
        const ERR_INVALID_USER_DATA= 73;
        const ERR_INVALID_USER_ID= 74;
        const ERR_INVALID_USER_INFORMATION_ID= 75;
        const ERR_CREATE_USER_INFORMATION= 76;
        const ERR_REMOVE_USER_INFORMATION= 77;
        const ERR_UPDATE_USER_INFORMATION= 78;
        const ERR_GET_USER_INFORMATION= 79;
        const ERR_GET_ALL_USERS_INFORMATION= 80;
    }

    class UserInformationHandler{
        private $connection;

        public function __construct(){
            $this->connection = (new DatabaseConnection())->getInstance();
        }

        public function create(int $user_id, string $name, string $surname, string $dni, string $email){
            if( !is_null($name) && !empty($name) && !is_null($surname) && !empty($surname) && !is_null($dni) && !empty($dni) && !is_null($email) && !empty($email) ){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_INVALID_USER_DATA) ;
            }
            
            if( !is_null($user_id) && $user_id > 0 ){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_INVALID_USER_ID) ;;
            }

            try{
                $SQLStatement = $this->connection->prepare("CALL `usp_create_user_information`(:user_id, :name, :surname, :dni, :email)");
                $SQLStatement->bindParam(':user_id', $user_id);
                $SQLStatement->bindParam(':name', $name);
                $SQLStatement->bindParam(':surname', $surname);
                $SQLStatement->bindParam(':dni', $dni);
                $SQLStatement->bindParam(':email', $email);
                $SQLStatement->execute();
            }catch(PDOException $dbException){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_CREATE_USER_INFORMATION) ;;
            }
        }

        public function remove(int $user_information_id){
            if( !is_null($user_information_id) && $user_information_id > 0){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_INVALID_USER_INFORMATION_ID) ;;
            }

            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_delete_user_information`(:id_user_information)");
                $SQLStatement->bindParam(':id_user_information', $user_information_id);
                $SQLStatement->execute();
            }catch(PDOException $dbException){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_REMOVE_USER_INFORMATION) ;;
            }
        }
        
        public function update(int $user_id, string $name, string $surname, string $dni, string $email){
            if( !is_null($name) && !empty($name) && !is_null($surname) && !empty($surname) && !is_null($dni) && !empty($dni) && !is_null($email) && !empty($email) ){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_INVALID_USER_DATA) ;;
            }
            
            if( !is_null($user_id) && $user_id > 0){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_INVALID_USER_ID) ;;
            }

            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_update_user_information`(:id_user_information, :name, :description)");
                $SQLStatement->bindParam(':id_user_information', $name);
                $SQLStatement->bindParam(':name', $description);
                $SQLStatement->bindParam(':description', $description);
                $SQLStatement->execute();
            }catch(PDOException $dbException){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_UPDATE_USER_INFORMATION) ;;
            }
        }
        
        public function get(int $user_id){
            if( !is_null($user_id) && $user_id > 0 ){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_INVALID_USER_ID) ;;
            }

            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_get_user_information`(:id_user_information)");
                $SQLStatement->bindParam(':id_user_information', $user_id);
                $SQLStatement->execute();
                $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
                return $response;
            }catch(PDOException $dbException){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_GET_USER_INFORMATION) ;;
            }
        }
        
        public function getAll(){
            try{
                $SQLStatement =$this->connection->prepare("CALL `usp_getAll_user_information`()");
                $SQLStatement->execute();
                $response = $SQLStatement->fetchAll(PDO::FETCH_ASSOC);
                return $response;
            }catch(PDOException $dbException){
                throw Exception('Error', UserInformationHandlerErrorTypes::ERR_GET_ALL_USERS_INFORMATION) ;;
            }
        }

    };

?>