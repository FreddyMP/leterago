<?php
class Ubicaciones{

    public function create($codigo, $description, $id_user){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $query= "INSERT INTO ubicaciones (codigo, description, create_by) values ('$codigo', '$description', '$id_user')";
        $con->query($query);

    }

    public function edit($id, $id_user, $codigo, $description){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $modify_date = date("Y-m-d :His");
        $query="UPDATE ubicaciones set codigo = '$codigo', description= '$description', modify_date = '$modify_date', modify_by= '$id_user'
        where id = $id";
        try {
            $con->query($query);
            return '1';
        } catch (\Throwable $th) {
            return '0';
        }
        
    }

    public function list(){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * from ubicaciones where delete_date is null";
        $exc_query = $con->query($query);

        return $exc_query;
    }

     public function find($id){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM ubicaciones where id = $id";

        $exc_query = $con->query($query);

        $Ubicaciones = mysqli_fetch_assoc($exc_query);

        return $Ubicaciones;
     }
     
     public function delete($id, $id_user){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $query_equipo = "SELECT count(*) as count FROM equipos where id_almacen = $id";
        $exc_equipo = $con->query($query_equipo);
        $equipos = mysqli_fetch_assoc($exc_equipo);
        $equipos_count = $equipos["count"];

        if($equipos_count == 0){

            $delete_date = date("Y-m-d :His");
            $query="UPDATE ubicaciones set delete_date = '$delete_date', delete_by= '$id_user'
            where id = $id";
            try {
                $con->query($query);
                return '1';
            } catch (\Throwable $th) {
                return '0';
            }
        }
        
     }
}
?>