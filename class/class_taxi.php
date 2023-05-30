<?php
    //print_r($stmt->errorInfo());
    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  
    include_once 'db.php';
    class user_class extends Database {  
        //name of the table
        private $table_name = "user";
        //name of the table's columns
        //public $id;
        //public $name;
        //public $last_name;
        //public $email;
        //public $password;

        //creation of the connection
        public function __construct(){    
            $this->conn = $this->getConnection();
        }

        //get all users
        public function getAllUsers()
        {
            $stmt = $this->conn->prepare("
            SELECT
            `user`.`id` as 'user_id', 
            `user`.`name` as 'user_name',
            `user`.`lastname` as 'user_last_name',
            `user`.`email` as 'user_email'
            FROM `user`
            ORDER by `user`.`id` ASC
            ");
            if ($stmt->execute())
                {
                    $result = array();
                    if($stmt->rowCount() > 0){
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $item = array(
                                        'user_id' => $row['user_id'],
                                        'user_name' => $row['user_name'],
                                        'user_last_name' => $row['user_last_name'],
                                        'user_email' => $row['user_email']
                                         );
                            array_push($result , $item);
                        }
                    }
                    return $result;
                }
            else
                return false;        
        }

        //get a single user
        public function getUser($user_id,$email)
        {
            $where_clause = '';
            if(isset($user_id))
                $where_clause = " WHERE `user`.`id`=  $user_id";

            if(isset($email))
                $where_clause = " WHERE `user`.`email` =  '$email'";

            $stmt = $this->conn->prepare("
            SELECT
            `user`.`id` as 'user_id', 
            `user`.`name` as 'user_name',
            `user`.`lastname` as 'user_last_name',
            `user`.`email` as 'user_email'
            FROM `user`
            $where_clause
            ORDER by `user`.`id` ASC
            ");
            if ($stmt->execute())
                //return $stmt;
                {
                    $result = array();
                    if($stmt->rowCount() > 0){
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $item = array(
                                        'user_id' => $row['user_id'],
                                        'user_name' => $row['user_name'],
                                        'user_last_name' => $row['user_last_name'],
                                        'user_email' => $row['user_email']
                                         );
                            array_push($result , $item);
                        }
                    }
                    return $result;
                }
            else
                return false;        
        }
        
        //insert user
        public function insertUser( $name, $last_name, $email, $password){                  
            $stmt= $this->conn->prepare("INSERT INTO `user` (`id`, `name`, `lastname`, `email`, `password`) 
                                         VALUES (NULL, :name, :last_name, :email, :password);") ;
            $stmt->bindValue('name', $name);
            $stmt->bindValue('last_name', $last_name);
            $stmt->bindValue('email', $email);
            $stmt->bindValue('password', $password);
            
            if ($stmt->execute())
                return true;
            else
                return false;
             
 
        }
        
        //update user
        public function updateUser($id, $name, $last_name, $email,  $password){ 
            $stmt = $this->conn->prepare("SELECT id FROM `user` WHERE `user`.`id` = :id;");
            $stmt->execute(array(':id' => $id));
            if ($stmt->rowCount()) {
                $stmt = $this->conn->prepare("
                UPDATE `user` SET 
                `name` = :name, 
                `lastname` = :last_name, 
                `email` = :email, 
                `password` = :password 
                WHERE `user`.`id` = :id;
                ");

                $stmt->bindValue('id', $id);
                $stmt->bindValue('name', $name);
                $stmt->bindValue('last_name', $last_name);
                $stmt->bindValue('email', $email);
                $stmt->bindValue('password', $password);
               
                if ($stmt->execute())
                    return true;
                else
                    return false;
                }
            else
                return false;
                  
        }

        //update user
        public function deleteUser($id){
            $stmt = $this->conn->prepare("DELETE FROM `user` WHERE `user`.`id` = :id");
            if ($stmt->execute(array('id' => $id)))
                return true;
            else
                return false;         
        }
      }*/
?>


<?php
    //print_r($stmt->errorInfo());
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include_once 'db.php';
    
    class TaxiClass extends Database {  
        private $table_name = "taxi"; // Nombre de la tabla
        
        // Campos de la tabla
        //public $id;
        //public $marca;
        //public $modelo;
        //public $anio;
        //public $color;
        //public $conductor;
        //public $ubicacion;

        public function __construct() {    
            $this->conn = $this->getConnection();
        }

        // Obtener todos los taxis
        public function getAllTaxis() {
            $stmt = $this->conn->prepare("
                SELECT
                    `taxi`.`id` as 'taxi_id', 
                    `taxi`.`marca` as 'taxi_marca',
                    `taxi`.`modelo` as 'taxi_modelo',
                    `taxi`.`anio` as 'taxi_anio',
                    `taxi`.`color` as 'taxi_color',
                    `taxi`.`conductor` as 'taxi_conductor',
                    `taxi`.`ubicacion` as 'taxi_ubicacion'
                FROM `taxi`
                ORDER BY `taxi`.`id` ASC
            ");
            
            if ($stmt->execute()) {
                $result = array();
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $item = array(
                            'taxi_id' => $row['taxi_id'],
                            'taxi_marca' => $row['taxi_marca'],
                            'taxi_modelo' => $row['taxi_modelo'],
                            'taxi_anio' => $row['taxi_anio'],
                            'taxi_color' => $row['taxi_color'],
                            'taxi_conductor' => $row['taxi_conductor'],
                            'taxi_ubicacion' => $row['taxi_ubicacion']
                        );
                        array_push($result, $item);
                    }
                }
                return $result;
            } else {
                return false;
            }
        }

        // Obtener un solo taxi
        public function getTaxi($taxi_id, $marca) {
            $where_clause = '';
            if (isset($taxi_id))
                $where_clause = " WHERE `taxi`.`id` = $taxi_id";

            if (isset($marca))
                $where_clause = " WHERE `taxi`.`marca` = '$marca'";

            $stmt = $this->conn->prepare("
                SELECT
                    `taxi`.`id` as 'taxi_id', 
                    `taxi`.`marca` as 'taxi_marca',
                    `taxi`.`modelo` as 'taxi_modelo',
                    `taxi`.`anio` as 'taxi_anio',
                    `taxi`.`color` as 'taxi_color',
                    `taxi`.`conductor` as 'taxi_conductor',
                    `taxi`.`ubicacion` as 'taxi_ubicacion'
                FROM `taxi`
                $where_clause
                ORDER BY `taxi`.`id` ASC
            ");
            
            if ($stmt->execute()) {
                $result = array();
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $item = array(
                            'taxi_id' => $row['taxi_id'],
                            'taxi_marca' => $row['taxi_marca'],
                            'taxi_modelo' => $row['taxi_modelo'],
                            'taxi_anio' => $row['taxi_anio'],
                            'taxi_color' => $row['taxi_color'],
                            'taxi_conductor' => $row['taxi_conductor'],
                            'taxi_ubicacion' => $row['taxi_ubicacion']
                        );
                        array_push($result, $item);
                    }
                }
                return $result;
            } else {
                return false;
            }
        }
        
        // Insertar taxi
        public function insertTaxi($marca, $modelo, $anio, $color, $conductor, $ubicacion) {                  
            $stmt = $this->conn->prepare("
                INSERT INTO `taxi` (`id`, `marca`, `modelo`, `anio`, `color`, `conductor`, `ubicacion`) 
                VALUES (NULL, :marca, :modelo, :anio, :color, :conductor, :ubicacion)
            ");
            $stmt->bindValue('marca', $marca);
            $stmt->bindValue('modelo', $modelo);
            $stmt->bindValue('anio', $anio);
            $stmt->bindValue('color', $color);
            $stmt->bindValue('conductor', $conductor);
            $stmt->bindValue('ubicacion', $ubicacion);
            
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        
        // Actualizar taxi
        public function updateTaxi($id, $marca, $modelo, $anio, $color, $conductor, $ubicacion) { 
            $stmt = $this->conn->prepare("SELECT id FROM `taxi` WHERE `taxi`.`id` = :id");
            $stmt->execute(array(':id' => $id));
            
            if ($stmt->rowCount()) {
                $stmt = $this->conn->prepare("
                    UPDATE `taxi` SET 
                    `marca` = :marca, 
                    `modelo` = :modelo, 
                    `anio` = :anio, 
                    `color` = :color, 
                    `conductor` = :conductor, 
                    `ubicacion` = :ubicacion 
                    WHERE `taxi`.`id` = :id
                ");

                $stmt->bindValue('id', $id);
                $stmt->bindValue('marca', $marca);
                $stmt->bindValue('modelo', $modelo);
                $stmt->bindValue('anio', $anio);
                $stmt->bindValue('color', $color);
                $stmt->bindValue('conductor', $conductor);
                $stmt->bindValue('ubicacion', $ubicacion);
               
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Eliminar taxi
        public function deleteTaxi($id) {
            $stmt = $this->conn->prepare("DELETE FROM `taxi` WHERE `taxi`.`id` = :id");
            
            if ($stmt->execute(array('id' => $id))) {
                return true;
            } else {
                return false;
            }         
        }
    }
?>
