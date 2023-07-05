<?php
include("../model/actividades.php");
session_start();
$actividades_instance = new Actividades();

$id = $_GET["id"];

$id_user = $_SESSION["usuario_Log_Id"];

$Actividades= $actividades_instance->delete($id, $id_user);

if($Actividades=='1'){
    header("location:../list_actividades.php");
}else{
    header("location:../list_actividades.php?error_delete=1");
}

?>