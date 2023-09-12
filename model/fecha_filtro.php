<?php

function filtro_fecha($fecha_desde, $fecha_hasta){
    $filtros = null;
    if($fecha_desde != '' && $fecha_hasta != ''){
        $filtros = " and (m.fecha > '".$fecha_desde."' or m.fecha = '".$fecha_desde."') 
                     and (m.fecha < '".$fecha_hasta."' or m.fecha = '".$fecha_hasta."')";
    }
    if($fecha_desde != '' && $fecha_hasta == '' ){
        $filtros = " and (m.fecha > '".$fecha_desde."' or m.fecha = '".$fecha_desde."')";
    }
    if($fecha_hasta != '' && $fecha_desde == ''){
        $filtros = " and (m.fecha < '".$fecha_hasta."' or m.fecha = '".$fecha_hasta."')";
    }

    return $filtros;
}
?>