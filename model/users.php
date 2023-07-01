<?php
    class Users{

        public function logIn(String $username, String $password ){
            include("kon.php");
            $conectar = new Kon();
            $con = $conectar->conn();

            $password_hash = hash('ripemd160',$password);
            $query = "SELECT id, id_rol, username, password from usuarios where username= '$username' and password = '$password_hash' and delete_date is null limit 1";
            $exc_query = mysqli_query($con, $query);

            $acceso= 0;
            $logIn = array();
            while($row = mysqli_fetch_assoc($exc_query)){
                $acceso = 1;
                $rol = $row["id_rol"];
                $usuario = $row["username"];
                $id = $row["id"];
                array_push($logIn, $acceso, $id, $usuario, $rol);
            }

            if($logIn[0] == 0){
                array_push($logIn,$acceso);
            }

            return $logIn;
        }

        public function logOut(){
            include("kon.php");
            session_destroy();
            
            header("location:../index.php");
        }

        public function create_user($username, $password, $name, $lastname, $rol){
            include("kon.php");
            session_start();
            $conexion = new Kon();

            $con = $conexion->conn();

            $create_by = $_SESSION["usuario_Log_Id"];
            $password_hash = hash('ripemd160',$password);

            $query = "INSERT INTO usuarios (username, password, name, lastname, id_rol, create_by)
            values ('$username','$password_hash','$name', '$lastname', $rol, '$create_by')";
            try {
                $exc_query = mysqli_query($con, $query);
            } catch (\Throwable $th) {
                return "Algo no funciono";
            }
           
        }

        public function edit_user($username, $password, $name, $lastname, $rol, $id){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $password_hash = hash('ripemd160',$password);

            $query = "UPDATE usuarios set username = '$username', password = '$password_hash', 
            name = '$name', lastname = '$lastname', id_rol = $rol where id = $id";

            try {
                $exc_query = mysqli_query($con, $query);
            } catch (\Throwable $th) {  
                return "Algo no funciono";
            }

        }

        public function permisos(){
            include("kon.php");
            $conexion = new Kon();

            $con = $conexion->conn();
         
            $rol = $_SESSION["usuario_Log_Rol"];
            $query = "SELECT * FROM rolpermisos where id_Rol = $rol";

            $exc_query = mysqli_query($con, $query);

            $Permisos = mysqli_fetch_assoc($exc_query);

            return $Permisos;

        }

        public function list(){
          
            $conexion = new Kon();

            $con = $conexion->conn();
            $query = "SELECT * FROM usuarios where id <> 1 and delete_date is null ";

            $exc_query = mysqli_query($con, $query);
         

            return $exc_query;
        }

        public function find ($id){

            $conexion = new Kon();

            $con = $conexion->conn();
            $query = "SELECT * FROM usuarios where id = $id and delete_date is null ";

            $exc_query = mysqli_query($con, $query);

            $Usuarios = mysqli_fetch_assoc($exc_query);
         

            return $Usuarios;
        }

        public function delete($id, $id_username){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $delete_date = date("Y-m-d :His");

            $query = "UPDATE usuarios set delete_date =  '$delete_date', delete_by = '$id_username' where  id = $id";
            $exc_query= $con->query($query);
        }
    }

?>
