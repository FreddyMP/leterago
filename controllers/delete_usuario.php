<?php
include("../model/users.php");
session_start();

$id = $_GET["id"];

$usuario_instance = new Users();

$id_username =  $_SESSION["usuario_Log_Id"];

$usuarios = $usuario_instance->delete($id,$id_username);

header("location:../list_usuarios.php?delete=1");
?>