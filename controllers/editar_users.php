<?php

include("../model/users.php");

$edit_user = new Users();

echo $username = $_POST["username"];
echo $name = $_POST["name"];
echo $lastname = $_POST["lastname"];
echo $password = $_POST["password"];
echo $rol = $_POST["rol"];
echo $id = $_POST["id"];

 $editar_usuario = $edit_user->edit_user($username, $password, $name, $lastname, $rol, $id);

if($editar_usuario == "Algo no funciono"){
    header("location:../create_users.php?error_create=1");
 }else{
     header("location:../list_usuarios.php");
 }
?>