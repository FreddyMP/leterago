<?php
include("../model/kon.php");

$Kon_instance = new Kon();

$conexion = $Kon_instance->conn();

$query = "SELECT ubicacion, id from equipos";

$ejecutar = $conexion->query($query);

while($row = mysqli_fetch_assoc($ejecutar)){
    $ubicacion = $row["ubicacion"];

    $update = "UPDATE equipos 
    set ubicacion = (select id from ubicaciones where description = '$ubicacion' limit 1)
    where ubicacion = '$ubicacion'";
//Área de Cómputos (Almacen II)
    $conexion->query($update    );
}
?>