<?php
    class Categorias{

        public function create($codigo, $description, $id_user){
            include("kon.php");
            $conexion = new Kon();

            $con = $conexion->conn();

            $query = "INSERT INTO categorias (codigo, description, create_by) VALUES ('$codigo', '$description', '$id_user')";
            try {
                $con->query($query);
                return '1';
            } catch (\Throwable $th) {
                return '0';
            }
            
        }

        public function edit($id, $id_user, $codigo, $description){
            include("kon.php");

            $conexion = new Kon();
            $con = $conexion->conn();

            $modify_date = date("Y-m-d :His");

            $query="UPDATE categorias SET codigo = '$codigo', description = '$description', modify_date = '$modify_date', modify_by = '$id_user' where id = $id";
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

            $query = "SELECT * FROM categorias where delete_date is null";

            $exc_categorias = $con->query($query);

            return $exc_categorias;
        }

        public function find($id){
            $conexion = new Kon();

            $con = $conexion->conn();

            $query = "SELECT * FROM categorias where id = $id";

            $exc_categorias = $con->query($query);

            $categorias = mysqli_fetch_assoc($exc_categorias);

            return $categorias;
        }

        public function delete($id, $id_user){
            include("kon.php");
            $conexion = new Kon();

            $con = $conexion->conn();

            $query_equipo = "SELECT count(*) as count FROM equipos where id_categoria = $id";
            $exc_equipo = $con->query($query_equipo);
            $equipos = mysqli_fetch_assoc($exc_equipo);
            $equipos_count = $equipos["count"];
    
            if($equipos_count == 0){

                $delete_date = date("Y-m-d :His");
                $query = "UPDATE categorias SET delete_Date='$delete_date', delete_by = '$id_user' where id = '$id'";
                $exc_categorias = $con->query($query);
                return "1";
            }else{
                return "2";
            }
        }


    }
?>