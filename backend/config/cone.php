<?php
class Conexion{
   public $host = "localhost";
   public $db_name = "Leterago";
   public $user_name= "root";
   public $password = "";
   
   public function conectar(){
        try {
            $connec = new mysqli($this->host, $this->user_name, $this->password, $this->db_name);
            return $connec;
        } catch (\Throwable $th) {
            echo "no conecto";
        }
    }

}



?>