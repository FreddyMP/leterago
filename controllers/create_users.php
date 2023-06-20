<?php
include("../model/users.php");

$new_user = new Users();

$username = $_POST["username"];
$name = $_POST["name"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];
$rol = $_POST["rol"];
$id = $_POST["id"];

$create_user =   $new_user->create_user($username, $password, $name, $lastname, $rol);
              
if($create_user == "Algo no funciono"){
   header("location:../create_users.php?error_create=1");
}else{
    header("location:../list_usuarios.php");
}
?>