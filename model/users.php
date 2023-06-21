<?php
include("kon.php");

    class Users{

        public function logIn(String $username, String $password ){

            $conectar = new Kon();
            $con = $conectar->conn();

            $password_hash = hash('ripemd160',$password);
            $query = "SELECT id, id_rol, username, password from usuarios where username= '$username' and password = '$password_hash' limit 1";
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
            session_destroy();
            
            header("location:../index.php");
        }

        public function create_user($username, $password, $name, $lastname, $rol){

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

    }

?>
