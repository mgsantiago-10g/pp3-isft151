<?php

    class Connection{
        private $isft_db;

        public function __construct()
        {

            try
            {
                $json_path = 'http://localhost/pp-isft151-2022/config/config.json';
                $json_obj = file_get_contents($json_path);
                $array = json_decode($json_obj, true);
                $isft_db_host = $array['databases']['isft-db']["host"];
                $isft_db_user = $array['databases']['isft-db']["user"];
                $isft_db_pass = $array['databases']['isft-db']["pass"];
                $isft_db_name = $array['databases']['isft-db']["db_name"];

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

        public function get_connection_isft_db()
        {
            return $this->isft_db;
        }
    };

?>