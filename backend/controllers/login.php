<?php
    include("../model/users.php");

    $logeado = new Users();

    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];

    $acceso = $logeado->logIn($usuario, $contrasena);

    if($acceso[0] == 1){
        session_start();
        $_SESSION["usuario_Log_Username"] = $acceso[2];
        $_SESSION["usuario_Log_Id"] = $acceso[1];
        $_SESSION["usuario_Log_Rol"] = $acceso[3];
        header("location:../../views/home.php");
    }else{
        header("location:../../index.php?Error_log=1");
    }

?>