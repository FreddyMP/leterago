<?php
include("kon.php");

    class Users{

        public function logIn(String $username, String $password ){

            $conectar = new Kon();
            $con = $conectar->conn();

            $password_hash = hash('ripemd160',$password);
            $query = "SELECT id, id_rol, username, password from usuarios where username= '$username' and password = '$password' limit 1";
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
    }


?>
