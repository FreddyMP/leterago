<?php
include("../model/almacenes.php");

session_start();

$id=$_GET["id"];
$id_username = $_SESSION["usuario_Log_Id"];

$Almacen_instance =  new Almacenes();

$almacen = $Almacen_instance->delete($id, $id_username);

if($almacen == 1){
    header("location:../list_almacenes.php");
}else{
    header("location:../list_almacenes.php?error_borrado=1");
}

?>