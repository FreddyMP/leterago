<?php
include_once("../model/calendario.php");
$calendario_instance =  new Calendario();

session_start();

/*Se usa el metodo count para verificar la cantidad de posiciones que tiene el array, ya que la ultima posicion
es el id del equipo*/

/*Se usa el metodo explode porque las fechas llegan como un string con las fechas separadas por coma(,)
*/

$fechas_recibidas = $_POST["fechas"]; 

$fechas_array = explode(",",$fechas_recibidas);
$cantidad_posiciones =  count($fechas_array);

$cantidad_sin_posicion_equipo = $cantidad_posiciones - 1;

$id_user = $_SESSION["usuario_Log_Id"];

$contador = 1;

echo $fechas_recibidas;


while($contador <= $cantidad_sin_posicion_equipo){
    $posicion = $contador-1;
    $fecha = $fechas_array[$posicion];
    $equipo = $fechas_array[$cantidad_posiciones-1];
    $insert = $calendario_instance->guardar_fechas($fecha, $equipo, $id_user);
    $contador++;
}



?>