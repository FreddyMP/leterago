<?php
    class Programas {

        public function create($rpg, $for, $version, $fecha_init, $fecha_fin, $description, $id_user){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $temp = rand(1,99999);

            $query = "INSERT INTO programaheader (doc_no, doc_relacionado, fecha_ini, fecha_fin, descripcion, version, temp, create_by) 
            VALUE ('$rpg', '$for', '$fecha_init', '$fecha_fin', '$description', $version, $temp, '$id_user')";

            try {
                $con->query($query);
                return $temp;
            } catch (\Throwable $th) {
                return $th;
            }
        }
        public function list_header(){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT * FROM programaheader where delete_date is null order by id desc";

            $exc = $con->query($query);
            return $exc;
        }

        public function find_temp($temp){
            
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT * FROM programaheader where temp = $temp";

            $exc = $con->query($query);

            $temp = mysqli_fetch_assoc($exc);

            return $temp;
        }

        public function create_details($id_header, $id_equipo){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "INSERT INTO programadetails (id_programaHeader, id_equipo) 
            VALUE ($id_header, $id_equipo)";

            try {
                $con->query($query);
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function find_details($id_header, $id_equipo){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT count(*) as existe FROM programadetails where id_programaHeader= $id_header and id_equipo = $id_equipo";

            $exc = $con->query($query);

            $existe = mysqli_fetch_assoc($exc);

            return $existe;
        }

        public  function delete_details($id_header, $id_equipo){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "DELETE FROM programadetails WHERE id_programaHeader = $id_header and id_equipo = $id_equipo";

            try {
                $con->query($query);
                return "1";
            } catch (\Throwable $th) {
                return "0";
            }
        }

        public  function list_details($id_header){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT programadetails.id_programaHeader as id_header, equipos.id as id_equipo,
            equipos.description as descripcion, equipos.codigo as codigo, equipos.marca as marca, equipos.modelo as modelo
            FROM programadetails
            inner join equipos on equipos.id = programadetails.id_equipo
            WHERE programadetails.id_programaHeader = $id_header";

            $exc = $con->query($query);

            return $exc;
        }

        public function add_all($id_header){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            try {
                $Limpiar = "DELETE from programadetails WHERE id_programaHeader = $id_header";
                $exc = $con->query($Limpiar);
    
                $query_equipos = "SELECT id from equipos where delete_date is null";
                $exc = $con->query($query_equipos);
    
                while($equipo = mysqli_fetch_assoc($exc)){
                    $id_equipo = $equipo["id"];
                    $query = "INSERT INTO programadetails (id_programaHeader, id_equipo) values ($id_header, $id_equipo)";
                    $exc = $con->query($query);
                }
    
                return 1;
            } catch (\Throwable $th) {
                return 2;
            }



        }

        public  function not_list_details($id_header){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT * FROM equipos 
                    where id not in (select id_equipo from programadetails where id_programaHeader = $id_header) order by id desc";

            $exc = $con->query($query);

            return $exc;
        }


        public function find($id){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT * FROM programaheader where id = $id";

            $exc = $con->query($query);

            $header = mysqli_fetch_assoc($exc);

            return $header;
        }

        public function find_active(){
            $conexion = new Kon();
            $con = $conexion->conn();

            $query = "SELECT * FROM programaheader where estado = 1";

            $exc = $con->query($query);

            $header = mysqli_fetch_assoc($exc);

            return $header;
        }

        public function edit($doc_no, $doc_relacionado, $version, $descripcion, $fecha_ini, $fecha_fin, $id_user, $id){
            include("kon.php");
            $conexion = new Kon();
            $con = $conexion->conn();

            $fecha =  date("Y-m-d :His");

            $query= "UPDATE programaheader set doc_no = '$doc_no', doc_relacionado = '$doc_relacionado', version = $version,
             descripcion = '$descripcion', fecha_ini = '$fecha_ini', fecha_fin = '$fecha_fin', modify_by= $id_user, 
             modify_date = '$fecha' where id = $id";

             try {
                $con->query($query);
                return "1";
             } catch (\Throwable $th) {
                return "0";
             }

        }

        public function delete(){

        }
    }
?>