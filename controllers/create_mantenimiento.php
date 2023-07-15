<?php
include("../model/mantenimiento.php");
$mantenimiento_instance = new Mantenimiento();

$documento_no = $_POST["documento_no"];
$version = $_POST["version"];
$documento_relacionado = $_POST["doc_relacionado"];
$codigo = $_POST["codigo"];
$fecha = $_POST["fecha"];
$ubicacion = $_POST["ubicacion"];
$equipo = $_POST["equipo"];
$observaciones = $_POST["observaciones"];

$mantenimiento = $mantenimiento_instance->create($documento_no, $version, $documento_relacionado, $codigo,
 $fecha, $ubicacion, $equipo, $observaciones);

/*En este codigo se llena los detalles de los mantenimientos digase las acciones realizadas.

se verifica si la cabecera ya tiene un codigo temporal para evitar mezcle con otra ejecucion al mismo tiempo,
digase para decir a esta cabecera pertenece estos detalles.

la cantidad_check esta en la carpeta reload/list_actions.php

El valor de mantenimiento es el codigo temporal en la tabla de mantenimientos.

*/

 if($mantenimiento != '0'){
    $ok = 0;
    $no_aplica = 0;
    $r = 0;
    $contador = 0;

    if(isset($_POST["cantidad_ckecks"])){
        $cantidad_checks = $_POST["cantidad_ckecks"];

        $mantenimiento_header = $mantenimiento_instance->obtener_header($mantenimiento);
        $id_mantenimiento = $mantenimiento_header["id"];

       while ($contador <= $cantidad_checks) {
            if(isset($_POST["ok".$contador])){
                $ok = 1;
            }else{
                $ok = 0;
            }
            if(isset($_POST["no_aplica".$contador])){
                $no_aplica = 1;
            }else{
                $no_aplica = 0;
            }
            if(isset($_POST["r".$contador])){
                $r = 1;
            }else{
                $r = 0;
            }
            if(isset($_POST["observaciones".$contador])){
                $observaciones = $_POST["observaciones".$contador];
            }else{
                $observaciones = NULL;
            }
        
        $insert_details = $mantenimiento_instance->create_details($id_mantenimiento, $ok, $no_aplica, $r, $observaciones );

        if($insert_details == '1'){
            $quitar_code_temp = $mantenimiento_instance->quitar_code_temp($mantenimiento);
            header("location:../list_mantenimientos.php");
        }
        else{
            header("location:../crear_mantenimiento.php?error_create=1"); 
        }
        $contador++;
       }
    }
 }else{
    header("location:../crear_mantenimiento.php?error_create=1");           
 }
?>