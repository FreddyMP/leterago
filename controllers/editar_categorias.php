<?php
include("../model/categorias.php");
session_start();
$Categorias_instance = new Categorias();

$id = $_POST["id"];
$id_user = $_SESSION["usuario_Log_Id"];
$codigo = $_POST["codigo"];
$description = $_POST["description"];

$categorias = $Categorias_instance->edit($id, $id_user, $codigo, $description);

if($categorias == 1){
    header("location:../list_categorias.php");
}else{
    header("location:../list_categorias.php?error_edit=1");
}


?>