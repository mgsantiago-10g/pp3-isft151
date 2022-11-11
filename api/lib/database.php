<?php

    class DatabaseConnection{
        private $isft_db;

        public function __construct()
        {

            try
            {
                $database_config_path = __DIR__.'/../../config/database.json';
                $database_config_json = file_get_contents($database_config_path);

                $database_config_obj = json_decode($database_config_json);
                $isft_db_host = $database_config_obj->host;
                $isft_db_user = $database_config_obj->user;
                $isft_db_pass = $database_config_obj->pass;
                $isft_db_name = $database_config_obj->name;

                $this->isft_db = new PDO('mysql:host='.$isft_db_host.';dbname='.$isft_db_name, $isft_db_user, $isft_db_pass );
                $this->isft_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            }
            catch (PDOException $connectionException) 
            {
                //Contestamos al cliente que su petición no se puede efectuar por un problema
                $status = array( 'status'=>'db-error', 'description'=>$connectionException->getMessage() );
                echo json_encode($status);

                //Cortamos la ejecución del programa del servidor de forma forzada
                die();
            };

        }

        public function getInstance()
        {
            return $this->isft_db;
        }
    };

?>
