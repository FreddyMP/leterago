<?php
    include("../model/actividades.php");
    session_start();

    $description = $_POST["description"];
    $id_user = $_SESSION["usuario_Log_Id"];

    $Actividades_instance = new Actividades();
    $actividades = $Actividades_instance->create($description, $id_user);

    if($actividades == "1"){
        header("location:../list_actividades.php");
    }else{
        header("location:../list_actividades.php?error_create=1");
    }
?>