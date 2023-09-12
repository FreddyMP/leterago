<?php
class Mantenimiento{

    public function create($documento_no, $version, $documento_relacionado, $codigo, $fecha, $fecha_planificacion, $ubicacion, $equipo, $observaciones = NULL, $razon_tardanza, $create_by){
        include("kon.php");

        $conexion = new Kon();

        $codigo_temporal = rand(1,10000);

        $con = $conexion->conn();

        $query = "INSERT INTO mantenimientos (`documento_no`, `version`, `documento_relacionado`, `codigo`, `fecha`, `date_planification`, `ubicacion`, `equipo`, `observaciones`,`razon_tardanza`, `codigo_temp`,`create_by`)
         VALUES ('$documento_no', '$version', '$documento_relacionado', '$codigo', '$fecha', '$fecha_planificacion', $ubicacion, $equipo, '$observaciones','$razon_tardanza', '$codigo_temporal', '$create_by')";

        try {
            $con->query($query);
            return $codigo_temporal;
        } catch (\Throwable $th) {
            return "0";
        }
    }

    public function create_details($id_mantenimiento, $id_actividad, $ok, $no_aplica, $r, $observaciones = NULL){

        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "INSERT INTO mantenimientos_details (id_mantenimiento, id_actividad, ok, no_aplica, r, observacion)
         VALUES ($id_mantenimiento,$id_actividad, $ok, $no_aplica, $r, '$observaciones')";

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

        $query = "SELECT m.id as id, e.codigo as documento, m.documento_relacionado as relacionado,
        e.description as description, m.fecha as fecha, u.description as ubicacion
        FROM mantenimientos m
        INNER JOIN equipos  e on e.id = m.equipo
        INNER JOIN ubicaciones u on u.id = e.ubicacion
        ORDER BY m.id desc";

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

    public function find_details($id){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT * FROM mantenimientos_details where id_mantenimiento = $id";
        $exc = $con->query($query);
      
        return $exc;
    }

    public function filter_all($codigo, $equipo, $ubicacion, $fecha_desde, $fecha_hasta ){
        include_once("kon.php");
        $conexion = new Kon();
        $con = $conexion->conn();

        $filtros = null;
        if($fecha_desde != '' && $fecha_hasta != ''){
            $filtros = " and (m.fecha > '".$fecha_desde."' or m.fecha = '".$fecha_desde."') 
                         and (m.fecha < '".$fecha_hasta."' or m.fecha = '".$fecha_hasta."')";
        }
        if($fecha_desde != '' && $fecha_hasta == '' ){
            $filtros = " and (m.fecha > '".$fecha_desde."' or m.fecha = '".$fecha_desde."')";
        }
        if($fecha_hasta != '' && $fecha_desde == ''){
            $filtros = " and (m.fecha < '".$fecha_hasta."' or m.fecha = '".$fecha_hasta."')";
        }

        $query = "SELECT m.id as id, e.codigo as documento, m.documento_relacionado as relacionado,
        e.description as description, m.fecha as fecha, u.description as ubicacion
        FROM mantenimientos m
        INNER JOIN equipos e on e.id = m.equipo
        INNER JOIN ubicaciones u on u.id = e.ubicacion
        where e.codigo like '%$codigo%'
        and e.description like '%$equipo%'
        and u.description like '%$ubicacion%'".$filtros." ORDER BY m.id desc";



        $exc = $con->query($query);
        
        return $exc;
    }

    public function find_by_equipo($id_equipo){
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT m.id as id, u.name as nombre, u.lastname as apellido, m.date_planification as fecha_planificacion,  
        fecha as fecha
        FROM mantenimientos m
        INNER JOIN equipos e on e.id = m.equipo
        INNER JOIN usuarios u on u.id = m.create_by
        where m.equipo = $id_equipo
        order by m.id desc";

        $exc = $con->query($query);
     
        return $exc;
    }

    public function filter_find_by_equipo($id_equipo, $nombre, $fecha_desde, $fecha_hasta){
        include("fecha_filtro.php");
        include("kon.php");
        
        $filtros = filtro_fecha($fecha_desde, $fecha_hasta);
        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "SELECT m.id as id, u.name as nombre, u.lastname as apellido, m.date_planification as fecha_planificacion,  
        fecha as fecha
        FROM mantenimientos m
        INNER JOIN equipos e on e.id = m.equipo
        INNER JOIN usuarios u on u.id = m.create_by
        where m.equipo = $id_equipo
        and (u.name like '%$nombre%' or u.lastname like '%$nombre%')
        ".$filtros." order by m.id desc";

        $exc = $con->query($query);
     
        return $exc;
    }

    public function delete(){

    }
}
?>