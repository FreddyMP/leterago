<?php
class Mantenimiento{

    public function create($documento_no, $version, $documento_relacionado, $codigo, $fecha, $ubicacion, $equipo, $observaciones = NULL, $razon_tardanza, $create_by){
        include("kon.php");

        $conexion = new Kon();

        $codigo_temporal = rand(1,10000);

        $con = $conexion->conn();

        $query = "INSERT INTO mantenimientos (`documento_no`, `version`, `documento_relacionado`, `codigo`, `fecha`, `ubicacion`, `equipo`, `observaciones`,`razon_tardanza`, `codigo_temp`,`create_by`)
         VALUES ('$documento_no', '$version', '$documento_relacionado', '$codigo', '$fecha', $ubicacion, $equipo, '$observaciones','$razon_tardanza', '$codigo_temporal', '$create_by')";

        try {
            $con->query($query);
            return $codigo_temporal;
        } catch (\Throwable $th) {
            return "0";
        }
    }

    public function create_details($id_mantenimiento, $ok, $no_aplica, $r, $observaciones = NULL){

        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "INSERT INTO mantenimientos_details (id_mantenimiento, ok, no_aplica, r, observacion)
         VALUES ($id_mantenimiento, $ok, $no_aplica, $r, '$observaciones')";

        try {
            $con->query($query);
            return "1";
        } catch (\Throwable $th) {
            return "2";
        }

    }

    public function obtener_header($codigo_temporal){

        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM mantenimientos where codigo_temp = '$codigo_temporal'";
        $exc = $con->query($query);
        $mantenimiento = mysqli_fetch_assoc($exc);

        return $mantenimiento;
    }

    public function quitar_code_temp($codigo_temporal){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "UPDATE mantenimientos SET codigo_temp = NULL WHERE codigo_temp='$codigo_temporal'";

        $con->query($query);



    }

    public function edit($id){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM mantenimientos where id = $id";

        try {
            $exc = $con->query($query);
            return   $exc;
        } catch (\Throwable $th) {
            //throw $th;
        }
    
    }


    public function list(){
    
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT m.id as id, m.documento_no as documento, m.documento_relacionado as relacionado, e.description as description, m.fecha as fecha
        FROM mantenimientos m
        INNER JOIN equipos  e on e.id = m.equipo";

        $exc = $con->query($query);

        return $exc;
    }


    public function find($id){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM mantenimientos where id = $id";
        $exc = $con->query($query);
        $mantenimiento = mysqli_fetch_assoc($exc);

        return $mantenimiento;
    }


    public function delete(){

    }
}
?>