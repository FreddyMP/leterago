<?php
include("../model/ubicaciones.php");
session_start();
$Ubicaciones_instance = new Ubicaciones();

#$codigo = $_POST["codigo"];
$description = $_POST["description"];


$comillas_dobles = '"';
$comillas_simples = "'";
$find_comillas_dobles = strpos($description, $comillas_dobles);
$find_comillas_simples = strpos($description, $comillas_simples);


if($find_comillas_dobles == null &&  $find_comillas_simples == null){
    $description = str_replace('""',"",$description);
}


$id_user =  $_SESSION["usuario_Log_Id"];

$ubicacion = $Ubicaciones_instance->create($description, $id_user);

header("location:../list_ubicaciones.php");
?>