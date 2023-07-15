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

    public function list_actividades_search($id_equipo){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM actividades 
                  where delete_date is null 
                  and id not in (SELECT id_actividad from equipos_actividad where id_equipo = $id_equipo)";

        $exc = $con->query($query);

        return $exc;
    }

    public function list_actividades_assig($id_equipo){
        include("kon.php");
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM actividades 
                  where delete_date is null  and id in (SELECT id_actividad from equipos_actividad where id_equipo = $id_equipo)";

        $exc = $con->query($query);

        return $exc;
    }
    public function delete($id){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $query="DELETE FROM equipos_actividad WHERE id = $id ";

        $con->query($query);
    }
}
?>