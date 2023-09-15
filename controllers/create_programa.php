<?php
    include("../model/programas.php");
    $programa_instance = new Programas();
    session_start();

    $id_user = $_SESSION["usuario_Log_Id"];

    $rpg = $_POST["doc_no"];
    $for = $_POST["doc_relacionado"];
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"];
    $version = $_POST["version"];
    $descripcion = $_POST["descripcion"];

    $programa = $programa_instance->create($rpg, $for, $version, $fecha_ini, $fecha_fin, $descripcion,  $id_user);

    if($programa != NULL){
        $temp = $programa;
        $id_header = $programa_instance->find_temp($temp);
        $id = $id_header["id"];
        
        header("location:../list_programas.php");
    }else{
        echo $programa;
    }
?>