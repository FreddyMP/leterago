<?php
include("../model/actividades.php");
session_start();
$actividades_instance = new Actividades();

$id = $_POST["id"];
$description = $_POST["description"];
$id_user = $_SESSION["usuario_Log_Id"];

$actividades = $actividades_instance->edit($id, $description, $id_user);

if($actividades == '1'){
    header("location:../list_actividades.php");
}else{
    header("location:../edit_actividades.php?error_edit=1&&id=$id");
}
?>