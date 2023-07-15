<?php
    class Ordenes{

        public function create($id_user, $documentoNum, $version, $documentorelacionado, $ordenNum, $fecha, $hora, $solicitado_por,
        $departamento, $nivelPrioridad, $areaOEquipo, $codigo, $ubicacion, $descripcion, $nota){

            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "INSERT INTO `ordentrabajoheader`(documentoNum, version, documentoRelacionado, orderNum, fecha, hora, solicitadoPor, departamento, nivelPrioridad, areaOEquipo, codigo, ubicacion, descripcion,nota, create_by)
             VALUES ('$documentoNum','$version','$documentorelacionado','$ordenNum','$fecha','$hora','$solicitado_por',
             '$departamento','$nivelPrioridad','$areaOEquipo','$codigo','$ubicacion','$descripcion','$nota','$id_user')";

            try {
                $exc = $con->query($query);
                return "1";
            } catch (\Throwable $th) {
                return "0";
            }
             

        }

        public function edit($id,$id_user, $documentoNum, $version, $documentorelacionado, $ordenNum, $fecha, $hora, $solicitado_por,
        $departamento, $nivelPrioridad, $areaOEquipo, $codigo, $ubicacion, $descripcion, $nota){
            
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