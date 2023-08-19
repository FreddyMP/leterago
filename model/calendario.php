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
        
    }
?>