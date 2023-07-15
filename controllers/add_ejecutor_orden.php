<?php
include("../model/ordenes_ejecutores.php");
session_start();
$ordenes_ejecutores_instance = new Ordernes_ejecutores();

$ejecutor = $_POST["ejecutor"];
$fecha = $_POST["fecha"];
$hora_inicio = $_POST["hora_inicio"];
$hora_fin = $_POST["hora_fin"];
$id = $_POST["id"];

$id_user = $_SESSION["usuario_Log_Id"];

$ordenes_ejecutores = $ordenes_ejecutores_instance->create($id, $ejecutor, $fecha, $hora_inicio, $hora_fin, $id_user);

header("location:../add_ejecutores_orden.php?id=$id");
?>