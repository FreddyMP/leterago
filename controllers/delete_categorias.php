<?php
include("../model/categorias.php");
session_start();
$Categorias_instance = new Categorias();

$id = $_GET["id"];
$id_user =  $_SESSION["usuario_Log_Id"];
$categorias = $Categorias_instance->delete($id, $id_user);

if($categorias == '1'){
    header("location:../list_categorias.php");
}else{
    header("location:../list_categorias.php?error_delete=1");
}
?>