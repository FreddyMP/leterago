<?php
include("../model/ubicaciones.php");
session_start();

$Ubicaciones_instance = new Ubicaciones();

$id_user = $_SESSION["usuario_Log_Id"];
$id = $_POST["id"];
#$codigo = $_POST["codigo"];
$description = $_POST["description"];

$ubicaciones = $Ubicaciones_instance->edit($id, $id_user, $description);

if ($ubicaciones == 1) {
    header("location:../list_ubicaciones.php");
}else{
    header("location:../list_ubicaciones.php?error_edit");
}
?>