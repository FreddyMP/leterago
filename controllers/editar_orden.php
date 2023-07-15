<?php
    include("../model/ordenes.php");
    session_start();
    $ordenes_instance = new Ordenes();

      $id = $_POST["id"];
      $id_user = $_SESSION["usuario_Log_Id"];
      $documentoNum = $_POST["documentoNum"];
      $version =$_POST["version"];
      $documentorelacionado = $_POST["documentorelacion"];
      $ordenNum =  $_POST["orden"];
      $fecha =  $_POST["fecha"];
      $hora = $_POST["hora"];
      $solicitado_por = $_POST["solicitadopor"];
      $departamento =$_POST["departamento"];
      $nivelPrioridad=$_POST["prioridades"];
      $areaOEquipo= $_POST["areaOEquipo"];
      $codigo= $_POST["codigo"];
      $ubicacion= $_POST["ubicacion"];
      $descripcion = $_POST["description"];
      $nota = $_POST["notas"];

      $orden = $ordenes_instance->edit($id, $id_user, $documentoNum, $version, $documentorelacionado, $ordenNum, $fecha, $hora,
       $solicitado_por, $departamento, $nivelPrioridad, $areaOEquipo, $codigo, $ubicacion, $descripcion, $nota);

    
       if($orden == '1')
        {
            header("location:../list_ordenes.php");
        }else{
           # header("location:../crear_ordenes.php?error_create=1");
        }


?>