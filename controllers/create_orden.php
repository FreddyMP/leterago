<?php
    include("../model/ordenes.php");
    session_start();
    $ordenes_instance = new Ordenes();

    $nombre_archivo = "";

    if(isset($_POST["submit"])) {
        $nombre_archivo = $_FILES["archivo"]["name"];
        $extension = pathinfo($nombre_archivo);
        $directorio_destino = "../archivos/";

        $ultimo_id = $ordenes_instance->last_id();
        
        $numero_documento = 0;

        if($ultimo_id["exitencia"] != 0){
            $numero_documento = $ultimo_id["id"] + 1;
        }
        

        $nombreOriginal = $nombre_archivo ; // Nombre original del archivo
        $nuevoNombre = "documento".$numero_documento.".".$extension['extension']; // Nuevo nombre que deseas asignar

    
        // Comprobar si el archivo ya existe en el directorio
        if(file_exists($directorio_destino . $nombre_archivo)) {
            echo "El archivo ya existe.";
        } else {
            // Mover el archivo cargado al directorio de destino
            if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $directorio_destino . $nombre_archivo)) {
                echo "El archivo se ha subido correctamente.";
            } else {
                echo "Ha ocurrido un error al subir el archivo.";
            }
        }

        if (file_exists("../archivos/".$nombreOriginal)) {
            if (rename("../archivos/".$nombreOriginal, "../archivos/".$nuevoNombre)) {
                echo "El archivo se ha renombrado correctamente.";
            } else {
                echo "Ha ocurrido un error al intentar renombrar el archivo.";
            }
        } else {
            echo "El archivo original no existe.";
        }
        
    }
    

        $id_user = $_SESSION["usuario_Log_Id"];
      #$documentoNum = $_POST["documentoNum"];
      #$version =$_POST["version"];
      #$documentorelacionado = $_POST["documentorelacion"];
    
      $ordenNum =  $_POST["orden"];
      $fecha =  $_POST["fecha"];
      #$hora = $_POST["hora"];
      $solicitado_por = $_POST["solicitadopor"];
      #$departamento =$_POST["departamento"];
      $nivelPrioridad=$_POST["prioridades"];
      #$areaOEquipo= $_POST["areaOEquipo"];
      #$codigo= $_POST["codigo"];
      #$ubicacion= $_POST["ubicacion"];
      #$descripcion = $_POST["description"];
      #$nota = $_POST["notas"];

      $orden = $ordenes_instance->create($id_user, $ordenNum, $nuevoNombre,$nombre_archivo, $fecha, 
       $solicitado_por, $nivelPrioridad);

    
       if($orden == '1')
        {
            header("location:../list_ordenes.php");
        }else{
            header("location:../crear_ordenes.php?error_create=1");
        }

        echo $nombre_archivo;
        

?>