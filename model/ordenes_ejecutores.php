<?php
    class Ordernes_ejecutores{

        public function create($id_orden, $realizado_por, $fecha, $hora_inicio, $hora_fin, $id_user){
            include("kon.php");
            $conexion = new Kon();

            $con = $conexion->conn();

            $query = "INSERT INTO `ordentrabajodetail`(`id_OrdenTrabajoHeader`, `realizado_por`, `fecha`, `horaIni`, `horaFin`, `create_by`) VALUES ($id_orden,'$realizado_por','$fecha','$hora_inicio','$hora_fin','$id_user') ";

           try {
            $con->query($query);
            return "1";
           } catch (\Throwable $th) {
            return $th;
           }

        }


        public function list($id){
                $conexion = new Kon();
                $con = $conexion->conn();

                $query = "SELECT * FROM ordentrabajodetail WHERE id_OrdenTrabajoHeader = $id";

                $exc = $con->query($query);

                return $exc;

        }


        public function find(){

        }

        public function edit(){

        }

        public function delete(){

        }
    }
?>