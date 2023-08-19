<?php
include("../model/calendario.php");
$calendario_instance = new Calendario();

$cantidad = $_POST["cantidad"];

$resultado = NULL;

$contador = 0;
try {
    while($contador < $cantidad){
        $id = $_POST["input_val_old".$contador];
        $news = $_POST["input_val_new".$contador];
        $modificar_fecha = $calendario_instance->edit($news, $id);
        $contador++;
    
        $resultado =  $modificar_fecha;
    }
    header("location:../list_calendario.php");
} catch (\Throwable $th) {
    
}


?>