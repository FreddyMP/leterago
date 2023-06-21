<?php
include("../model/almacenes.php");

$new_almacen = new Almacenes();

$codigo = $_POST["codigo"];
$descripcion = $_POST["description"];

$create_almacen =   $new_almacen->create_almacen($codigo, $descripcion);
              
if($create_almacen == "Algo no funciono"){
   header("location:../create_almacen.php?error_create=1");
}else{
    header("location:../list_almacenes.php");
}
?>