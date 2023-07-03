<?php
include("../model/rules.php");
session_start();

$id = $_GET["id"];
$id_username =  $_SESSION["usuario_Log_Id"];
echo $id;
$Rules_instance = new Rules();

$rules = $Rules_instance->delete($id,$id_username);

echo $rules;

if($rules == 1){
    header("location:../list_roles.php");
}
if($rules == 0){
    header("location:../list_roles.php?error_delete=1");
}

?>