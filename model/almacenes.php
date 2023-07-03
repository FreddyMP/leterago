<?php

class Almacenes{
    public function create_almacen($codigo, $description){
        include("kon.php");
        $conexion = new Kon();
        session_start();
        $con = $conexion->conn();

        $create_by = $_SESSION["usuario_Log_Username"];

        $query ="INSERT INTO almacenes (codigo, description, create_by) values('$codigo','$description','$create_by')"  ;

        try {
            $exc_query= mysqli_query($con, $query);
        } catch (\Throwable $th) {
            return "Algo no funciono";
        }
    }

    public function editar_almacen($id, $codigo, $description){
        include("kon.php");
        $conexion = new Kon();
        session_start();
        $con = $conexion->conn();

        $create_by = $_SESSION["usuario_Log_Username"];

        $query = "UPDATE almacenes set codigo='$codigo', description ='$description', create_by = '$create_by' WHERE id = $id";

        try {
            $exc_query= mysqli_query($con, $query);
        } catch (\Throwable $th) {
            return "Algo no funciono";
        }

    }

    public function list(){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT * from almacenes where delete_date is null order by id desc ";
        $exc_query = mysqli_query($con, $query);

       return $exc_query;
    }

    public function find($id){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM almacenes where delete_date is null and id = $id";
        $exc_query =  $con->query($query);

        $Almacenes = mysqli_fetch_assoc($exc_query);

        return $Almacenes;
    }

    public function delete($id, $id_username){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $query_equipo = "SELECT count(*) as count FROM equipos where id_almacen = $id";
        $exc_equipo = $con->query($query_equipo);
        $equipos = mysqli_fetch_assoc($exc_equipo);
        $equipos_count = $equipos["count"];

        if($equipos_count == 0){
            $delete_date = date("Y-m-d :His");
            $query_delete = "UPDATE almacenes set delete_date = '$delete_date', delete_by = '$id_username' where id = $id ";
            $exc_query = $con->query($query_delete);

            return '1';
        }
        else{
            return '0';
        }

       

    }
}
?>