<?php
class Actividades{
    public function create($description, $id_user){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $create_date = date("Y-m-d :His");
        $query_exist = "SELECT count(*) as conter FROM actividades where description = '$description'";

        $query="INSERT INTO actividades (description, create_date, create_by) VALUES ('$description','$create_date','$id_user')";

        $exc_query_exist = $con->query($query_exist);
        $contador = mysqli_fetch_assoc($exc_query_exist);

        if($contador["conter"] == 0)
        {
            $con->query($query);
            return "1";
        }else{
            return "0";
        }

    }

    public function find($id){

        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM actividades where id = $id";

        $exc_actividades = $con->query($query);
        $Actividades = mysqli_fetch_assoc($exc_actividades);

        return $Actividades;
    }

    public function list(){

        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM actividades where delete_date is null order by id desc";
        $exc_query_exist = $con->query($query);
        #$Actividades = mysqli_fetch_assoc($exc_query_exist);

        return $exc_query_exist;
    }
    public function edit($id, $description, $id_user ){
        include("kon.php");
        $conexion = new Kon();
        $con = $conexion->conn();

        $create_date = date("Y-m-d :His");
        $query_exist = "SELECT count(*) as conter FROM actividades where description = '$description'";

        $query= "UPDATE actividades SET description = '$description', modify_date = '$modify_date', modify_by = '$id_user'
        where id = $id";

        $exc_query_exist = $con->query($query_exist);
        $contador = mysqli_fetch_assoc($exc_query_exist);

        if($contador["conter"] == 0)
        {
            $con->query($query);
            return "1";
        }else{
            return "0";
        }


    }

    public function delete($id, $id_user){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $delete_date = date("Y-m-d :His");

        $query_equipos = "SELECT count(*) as contador FROM  equipos_actividad where  id_actividad = $id";

        $query="UPDATE actividades set delete_date ='$delete_date', delete_by = '$id_user' where id = $id";

        $exc_equipos = $con->query($query_equipos);
        $equipos = mysqli_fetch_assoc($exc_equipos);
        $contador= $equipos["contador"];

        if($contador < '1'){
            $con->query($query);
            return '0';
        }else{
            return '0';
        }

    }
}
?>