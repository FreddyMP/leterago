<?php
    include("../model/almacenes.php");

    $codigo = $_POST["codigo"];
    $descripcion = $_POST["description"];
    $id = $_POST["id"];

    $con_almacen = new Almacenes();

    
    $editar_almacen = $con_almacen->editar_almacen($id, $codigo, $descripcion);

if($editar_usuario == "Algo no funciono"){
    header("location:../create_almacen.php?error_create=1");
 }else{
     header("location:../list_almacenes.php");
 }

?>