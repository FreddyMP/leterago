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

        $query = "SELECT * from almacenes order by id desc ";
        $exc_query = mysqli_query($con, $query);

       return $exc_query;
    }
}
?>