<?php
include("../model/equipos.php");
    $equipos_instance = new Equipos();
    session_start();

 $id_user =  $_SESSION["usuario_Log_Id"];
 $id = $_POST["id"];
 $codigo = $_POST["codigo"];
 $description = $_POST["description"];
 $marca = $_POST["marca"];
 $modelo = $_POST["modelo"];
 $serie = $_POST["serie"];
 $estado = $_POST["estado"];
 #$categoria = $_POST["categoria"];
 #$almacen = $_POST["almacen"];
 $ubicaciones = $_POST["ubicacion"];
 $frecuencia = $_POST["frecuencia"];
 $orden = 0;
 if(isset($_POST["orden"])){
    $orden = 1;
 }
 $observaciones = $_POST["observaciones"];

 $equipo = $equipos_instance->edit($id, $id_user, $codigo, $description, $orden, $marca, $modelo, $serie, $estado, $observaciones,
 $ubicaciones, $frecuencia);

if($equipo=='1'){
    header("location:../list_equipos.php");
}else{
    header("location:../crear_equipo.php?error_create=1&&id=$id");
}


?>