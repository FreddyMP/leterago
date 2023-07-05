<?php
class Equipo_actividad{
    public function add($id_equipo, $id_actividad, $id_user){
        include("kon.php");
        
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "INSERT INTO equipos_actividad (id_equipo, id_actividad, create_by) VALUES ($id_equipo, $id_actividad, '$id_user') ";

        $con->query($query);
    }

    public function list($id_equipo){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM equipos_actividad WHERE id_equipo= $id_equipo ";

        $exce = $con->query($query);

        return $exce;
    }
}
?>