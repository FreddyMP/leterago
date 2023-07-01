<?php
class Equipos{

    public function list(){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT * from equipos order by id desc";
        $exc_query = mysqli_query($con, $query);

       return $exc_query;
    }
}
?>