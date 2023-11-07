<?php
    class Dashboard{

        public function a_tiempo($mes){
            include_once('kon.php');

            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT count(*) as numero 
                        from mantenimientos
                        where fecha = date_planification
                        and MONTH(date_planification) = '$mes'";

            $result = $con->query($query);

            $a_tiempo = mysqli_fetch_assoc($result);

            $a_tiempo = $a_tiempo["numero"];

            return $a_tiempo;
        }

        public function tarde($mes){
            include_once('kon.php');

            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT count(*) as numero 
                        from mantenimientos
                        where fecha > date_planification
                        and MONTH(date_planification) = '$mes'";

            $result = $con->query($query);

            $tardio = mysqli_fetch_assoc($result);

            $tardio = $tardio["numero"];

            return $tardio;
        }

        public function no_realizadas($mes){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT  count(*) as conteo
                      FROM fechas_ejecucion
                      inner join equipos on equipos.id = fechas_ejecucion.equipo
                      where realizado = 0
                      and MONTH(fecha) = '$mes'
                      order by fechas_ejecucion.fecha asc
                      ";

            $result = $con->query($query);

            $contador = mysqli_fetch_assoc($result);

            $no_realizados = $contador["conteo"];

            return $no_realizados;
        }

        public function count_equipos(){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT  count(*) as conteo
                      FROM equipos where delete_date is null";

            $result = $con->query($query);

            $contador = mysqli_fetch_assoc($result);

            $equipos = $contador["conteo"];

            return $equipos;
        }

        public function count_ubicaciones(){
            include_once("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT count(description) as conteo
                      FROM ubicaciones where delete_date is null ";

            $result = $con->query($query);

            $contador = mysqli_fetch_assoc($result);

            $Ubicaciones = $contador["conteo"];

            return $Ubicaciones;
        }


     


    }
?>