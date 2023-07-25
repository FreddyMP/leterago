<?php
    class Calendario{
        public function create($id_programa, $id_equipo, $fecha, $id_user){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "INSERT INTO calendario (id_programa, id_equipo, fecha, create_by)
             values ($id_programa, $id_equipo, $fecha, $id_user)";

             try {
                 $con->query($query);
                 return "1";
             } catch (\Throwable $th) {
                return "0";
             }
        }
    }
?>