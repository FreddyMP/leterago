<?php
    include("../model/categorias.php");
    session_start();

    $Categorias_instance = new Categorias();

    $codigo = $_POST["codigo"];
    $description = $_POST["description"];

    $id_user =  $_SESSION["usuario_Log_Id"];

    $categoria = $Categorias_instance->create($codigo, $description, $id_user);

                  
if($categoria == "0"){
   header("location:../crear_categorias.php?error_create=1");
 }else{
    header("location:../list_categorias.php");
 }
?>