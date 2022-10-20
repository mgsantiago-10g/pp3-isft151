<?php
	/* El nombre de la clase debe ser más descriptiva. Ejemplos: DatabaseConnection
	 * Si esta clase se encarga de alojar varias conexiones, entonces DBSConnections.*/
	  
    class Connection{
        private $isft_db;

        public function __construct()
        {

            try
            {
				/* Cambiar esta línea. La ruta debe ser relativa. No puede depender de la URL del servicio.
				 * La variable debería ser en todo caso: $database_config_path o similar.
				 * Si tienen problemas para cargar el archivo de configuración ayúdense con: 
				 * https://www.php.net/manual/en/function.file-get-contents.php (Ejemplo 2).
				 */
				$json_path = 'http://localhost/pp-isft151-2022/config/config.json';
                $json_obj = file_get_contents($json_path);
                
                /* Con respecto al JSON de Configuración:
                 * {
					"db":
						{
							"host":"127.0.0.1:5500",
							"user":"root",
							"pass":"root",
							"db_name":"isft-db"
						} 
					}
					
					Por cómo está siendo usada, "db" es el nombre de la conexión a la DB y db_name no es necesario.
					To-Do: Remover db_name y asumir el nombre del objeto como el nombre de la instancia de conexión.
				*/
                
                $array = json_decode($json_obj, true);
                
                //Cada clave del objeto JSON es una instancia de conexión. Retocar esta parte.
                //Si no quieren resolver la multiconexión a DB entonces, que la clase gestione una sola conexión. En ese caso
                //El config tendría que ser:
                /*
                 * {
						"host":"127.0.0.1:5500",
						"user":"root",
						"pass":"root",
						"name":"isft-db"
					}
				*/
				
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
	
		//El nombre del método no puede contener información sobre la implementación (no debe decir isft)
		//Puede ser: getInstance 
        public function get_connection_isft_db()
        {
            return $this->isft_db;
        }
    };

?>
