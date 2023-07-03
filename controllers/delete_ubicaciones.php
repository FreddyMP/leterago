<?php
include("../model/ubicaciones.php");
session_start();
$ubicaciones_instance = new Ubicaciones();

$id = $_GET["id"];
$id_user = $id_user =  $_SESSION["usuario_Log_Id"];
$ubicaciones = $ubicaciones_instance->delete($id, $id_user);


if($ubicaciones == 1){
    header("location:../list_ubicaciones.php");
}else{
    header("location:../list_ubicaciones.php?error_borrado=1");
}

?>