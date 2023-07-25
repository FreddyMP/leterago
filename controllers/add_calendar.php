<?php
include("../model/calendario.php");
$calendario_instance = new Calendario();
session_start();
$total = $_POST["total"];
$contado = 1;
$id_programa = $_POST["id_programa"];
$id_equipo = $_POST["id_equipo"];

$id_user = $_SESSION["usuario_Log_Id"];

while($contado <= $total){

    $fecha = $_POST["f".$contado];
    $calendario = $calendario_instance->create($id_programa, $id_equipo, $fecha, $id_user);

    $contado++;
}


?>