<?php
include("../model/kon.php");

$Kon_instance = new Kon();

$conexion = $Kon_instance->conn();

$query = "SELECT ubicacion, id from equipos";

$ejecutar = $conexion->query($query);

while($row = mysqli_fetch_assoc($ejecutar)){
    $ubicacion = $row["ubicacion"];
    $sql = "INSERT INTO ubicaciones (description, create_by) values ('$ubicacion', '1')";
    $conexion->query($sql);
}

?>