<?php
include("../model/programas.php");
$programas_instance = new Programas();

session_start();

$doc_no = $_POST["doc_no"];
$doc_relacionado = $_POST["doc_relacionado"];
$version = $_POST["version"];
$descripcion = $_POST["descripcion"];
$fecha_ini = $_POST["fecha_ini"];
$fecha_fin = $_POST["fecha_fin"];
$id_user = $_SESSION["usuario_Log_Id"];
$id = $_POST["id"];

$programas = $programas_instance->edit($doc_no, $doc_relacionado, $version, $descripcion, $fecha_ini, $fecha_fin, $id_user, $id);

if($programas == "1"){
    header("location:../list_programas.php");
}


?>