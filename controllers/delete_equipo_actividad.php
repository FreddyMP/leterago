<?php
include("../model/equipo_actividad.php");

$Equipo_actividad_intance = new Equipo_actividad();

$id=$_GET["id"];
$id_equipo = $_GET["id_equipo"];

$equipo_actividad = $Equipo_actividad_intance->delete($id);

header("location:../add_actividades.php?id=$id_equipo");