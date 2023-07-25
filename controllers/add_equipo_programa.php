<?php
include("../model/programas.php");

$programas_instance = new Programas();

$header = $_GET["id_header"];
$equipo = $_GET["id_equipo"];

$programa_details = $programas_instance->create_details($header, $equipo);

if($programa_details = '1'){
    if(isset($_GET["from_programa"])){
        header("location:../ver_programa.php?id=$header");
    }else{
        header("location:../programa_detalle.php?id_header=$header");
    }
   
}else{
    echo 'incorrecto';
}

?>