<?php
include("kon.php");
class Rules{

    public function create_rule(String $descripcion, String $creado_por = "Super_admin"){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "INSERT INTO  rol(description, create_by) values ('$descripcion','$creado_por')";
        $Insert_result = false;
        try {
            $exc_query = mysqli_query($con, $query);
            $Insert_result = true;
        } catch (\Throwable $th) {
            $Insert_result = false;
        }

        return $query;
    }

    public function count_exit(){
        $conectar = new Kon();
        $con = $conectar->conn();
        $last_id=0;

        $query = "SELECT id from rol order by id desc limit 1";
        $exc_query = mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($exc_query)){
            $last_id = $row["id"];
        }
        $next_id = $last_id + 1;

        return $next_id;
    }
}
?>