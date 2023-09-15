<?php
    class Ordenes{

        public function create($id_user, $ordenNum, $documento, $documento_original, $fecha, $solicitado_por, $nivelPrioridad){

            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "INSERT INTO `ordentrabajoheader`(orderNum, documento, documento_original , fecha, solicitadoPor, nivelPrioridad, create_by)
             VALUES ('$ordenNum','$documento','$documento_original','$fecha','$solicitado_por','$nivelPrioridad','$id_user')";

            try {
                $exc = $con->query($query);
                return "1";
            } catch (\Throwable $th) {
                return "0";
            }
             

        }

        public function edit($id,$id_user, $ordenNum, $fecha, $solicitado_por,
        $nivelPrioridad){
            
            include("kon.php");

            $conexion = new Kon();
            $con = $conexion->conn();

            $modify_date = date('Y-m-d :His');

            $query= "UPDATE ordentrabajoheader SET `documentoNum`='$documentoNum',`version`=$version,`documentoRelacionado`='$documentorelacionado',
            `orderNum`='$ordenNum', `fecha`='$fecha',`hora`='$hora',`solicitadoPor`='$solicitado_por',
            `departamento`='$departamento',`nivelPrioridad`='$nivelPrioridad',`areaOEquipo`='$areaOEquipo',`codigo`='$codigo',`ubicacion`='$ubicacion',`descripcion`='$departamento',`nota`='$nota',`modify_by`='$id_user',`modify_date`='$modify_date' WHERE id= $id";
            try {
                $con->query($query);
                return "1";
            } catch (\Throwable $th) {
                return "0";
            }
           

        }

        public function last_id(){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query="SELECT id, count(*) as exitencia FROM ordentrabajoheader order by id desc limit 1";
            $excute = $con->query($query);
            $orden = mysqli_fetch_assoc($excute);

            return $orden;
        }

        public function list(){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query ="SELECT * FROM ordentrabajoheader where delete_date is null";

            $Ordenes = $con->query($query);

            return $Ordenes;
        }

        public function find($id){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query="SELECT * FROM ordentrabajoheader where id = $id";
            $excute = $con->query($query);
            $orden = mysqli_fetch_assoc($excute);

            return $orden;
        }

        public function filter($orden, $solicitado_por, $fecha_desde, $fecha_hasta){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();


            $filtros = null;
            if($fecha_desde != '' && $fecha_hasta != ''){
                $filtros = " and (fecha > '".$fecha_desde."' or fecha = '".$fecha_desde."') 
                             and (fecha < '".$fecha_hasta."' or fecha = '".$fecha_hasta."')";
            }
            if($fecha_desde != '' && $fecha_hasta == '' ){
                $filtros = " and (fecha > '".$fecha_desde."' or fecha = '".$fecha_desde."')";
            }
            if($fecha_hasta != '' && $fecha_desde == ''){
                $filtros = " and (fecha < '".$fecha_hasta."' or fecha = '".$fecha_hasta."')";
            }

            $query ="SELECT * FROM ordentrabajoheader
             where delete_date is null
             and orderNum like '%$orden%'
             and solicitadoPor like '%$solicitado_por%' ".$filtros." ORDER BY id desc";

            $Ordenes = $con->query($query);

            return $Ordenes;
        }

        public function list_ordenes_search($id){
            $conexion = new Kon();
            $con = $conexion->conn();
    
            $query = "SELECT * FROM usuarios 
                      where delete_date is null 
                      and id not in (SELECT realizado_por from ordentrabajodetail where realizado_por = $id)";
    
            $exc = $con->query($query);
    
            return $exc;
        }

        public function delete(){

        }
    }
?>