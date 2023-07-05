<?php
include("../model/equipo_actividad.php");

$equipo_actividad_instance = new Equipo_actividad();
session_start();

$id_user= $_SESSION["usuario_Log_Id"];
$id_equipo = $_POST["id_equipo"];
$id_actividad = $_POST["id_actividad"];

$equipo_actividad = $equipo_actividad_instance->add($id_equipo, $id_actividad, $id_user);

header("location:../add_actividades.php?id=$id_equipo");
?>