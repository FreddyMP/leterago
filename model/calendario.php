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

        public function guardar_fechas($fecha, $equipo, $usuario){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "INSERT INTO fechas_ejecucion (fecha, equipo, create_by) values('$fecha', $equipo, '$usuario')";

            try {
               $exc = $con->query($query);
               return '1';
            } catch (\Throwable $th) {
               return '0';
            }

        }

        public function verificar_existencia($equipo){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT COUNT(*) as existen from fechas_ejecucion where equipo = $equipo";

            $exc = $con->query($query);

            $existen_registros = mysqli_fetch_assoc($exc);

            $cantidad_existente = $existen_registros["existen"];

            return $cantidad_existente;
        }

        public function find_equipos_programacion(){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT e.id as id, e.description as description, e.codigo as codigo,  e.frecuencia as frecuencia, e.marca as marca from programadetails pd
                        inner join programaheader ph on ph.id = pd.id_programaHeader
                        inner join equipos e on e.id = pd.id_equipo
             where ph.estado = 1 and e.delete_date is null";

            $exc = $con->query($query);

            return $exc;
        }

        public function filter_find_equipos_programacion($codigo, $nombre, $marca, $frecuencia){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT e.id as id, e.description as description, e.codigo as codigo,  e.frecuencia as frecuencia, e.marca as marca from programadetails pd
                        inner join programaheader ph on ph.id = pd.id_programaHeader
                        inner join equipos e on e.id = pd.id_equipo
                        where ph.estado = 1 
                        and e.delete_date is null
                        and e.codigo like '%$codigo%'
                        and e.description like '%$nombre%'
                        and e.marca like '%$marca%'
                        and e.frecuencia = $frecuencia";

            $exc = $con->query($query);

            return $exc;
        }

        public function list($equipo){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT * from fechas_ejecucion where equipo = $equipo";

            $exc = $con->query($query);

            return $exc;
        }

        public function edit($fechas_news, $id){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            try {
                $fecha_id = $id;
                $fecha_actualizada = $fechas_news;

                $query = "UPDATE fechas_ejecucion 
                              SET fecha = '$fecha_actualizada'
                              where id = '$fecha_id'";
    
                $exc = $con->query($query);

                $contador++;
    
                return 1;
            } catch (\Throwable $th) {
                return 0;
            }      
        }

        public function rango_fecha(){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT fecha_ini, fecha_fin from programaheader where  estado = 1 limit 1";

            $exc = $con->query($query);

            $fechas = mysqli_fetch_assoc($exc);

            return $fechas;


        }

        public function list_ejecuciones($programas){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT fechas_ejecucion.id as id, equipos.id as equipo, equipos.codigo as codigo, equipos.description as descripcion,
                      fechas_ejecucion.fecha as fecha
                      FROM fechas_ejecucion
                      inner join equipos on equipos.id = fechas_ejecucion.equipo
                      where realizado = 0
                      order by fechas_ejecucion.fecha asc
                      ";

                try {
                    $exc = $con->query($query);
                } catch (\Throwable $th) {
                    echo $th;
                }
            

            return $exc;
        }

        public function find_ejecucion($id){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT * FROM fechas_ejecucion where id = $id";

                try {
                    $exc = $con->query($query);

                    $fecha = mysqli_fetch_assoc($exc);

                    return $fecha;

                } catch (\Throwable $th) {
                    return '0';
                }
            
        }

        public function realizado($id){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "UPDATE fechas_ejecucion SET realizado = '1' where id = $id";

            $exc = $con->query($query);

            try {
                $exc = $con->query($query);
                return 1;
            } catch (\Throwable $th) {
                return 0;
            }

        }

        public function filter($id, $codigo, $nombre, $fecha_desde, $fecha_hasta){
            
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $filtros = null;
            if($fecha_desde != '' && $fecha_hasta != ''){
                $filtros = " and (fechas_ejecucion.fecha > '".$fecha_desde."' or fechas_ejecucion.fecha = '".$fecha_desde."') 
                             and (fechas_ejecucion.fecha < '".$fecha_hasta."' or fechas_ejecucion.fecha = '".$fecha_hasta."')";
            }
            if($fecha_desde != '' && $fecha_hasta == '' ){
                $filtros = " and (fechas_ejecucion.fecha > '".$fecha_desde."' or fechas_ejecucion.fecha = '".$fecha_desde."')";
            }
            if($fecha_hasta != '' && $fecha_desde == ''){
                $filtros = " and (fechas_ejecucion.fecha < '".$fecha_hasta."' or fechas_ejecucion.fecha = '".$fecha_hasta."')";
            }

            $query = "SELECT fechas_ejecucion.id as id, equipos.id as equipo, equipos.codigo as codigo, equipos.description as descripcion,
                      fechas_ejecucion.fecha as fecha
                      FROM fechas_ejecucion
                      inner join equipos on equipos.id = fechas_ejecucion.equipo
                      where realizado = 0
                      and equipos.codigo like '%$codigo%'
                      and equipos.description like '%$nombre%'".$filtros." order by fechas_ejecucion.fecha asc
                      ";
                try {
                    $exc = $con->query($query);
                } catch (\Throwable $th) {
                    echo $th;
                }
            

            return $exc;
        }

        public function contadores($estado){
           
            $conexion = new Kon();
            $con = $conexion->conn();

            $cantidad = null;

            if($estado == '1'){

                $hoy = date("Y-m-d");
                $query = "SELECT COUNT(*) AS cantidad from fechas_ejecucion where fecha < '$hoy' and realizado = 0";

                $exc = $con->query($query);

                $cantidad_registros = mysqli_fetch_assoc($exc);
                
                $cantidad = $cantidad_registros["cantidad"];
            }
            if($estado == '2'){

                $hoy = date("Y-m-d");
                $query = "SELECT COUNT(*) AS cantidad from fechas_ejecucion where fecha = '$hoy' and realizado = 0";

                $exc = $con->query($query);

                $cantidad_registros = mysqli_fetch_assoc($exc);

                $cantidad = $cantidad_registros["cantidad"];
                
            }
            if($estado == '3'){

                $hoy = date("Y-m-d");
                $manana = date("Y-m-d", strtotime($hoy . "+1 day"));
                $despues_tres_dias = date("Y-m-d", strtotime($hoy . "+3 day"));

                $query = "SELECT COUNT(*) AS cantidad from fechas_ejecucion where fecha >= '$manana' and fecha <=  '$despues_tres_dias' and realizado = 0";

                $exc = $con->query($query);

                $cantidad_registros = mysqli_fetch_assoc($exc);

                $cantidad = $cantidad_registros["cantidad"];
            }
            return $cantidad;

        }
        
    }
?>