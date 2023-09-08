<?php
class Equipos{

    public function create($id_user, $codigo, $description, $orden = 0, $categoria, $marca, $modelo, $serie, $estado, $observaciones = "N/A", $almacen, $ubicacion, $frecuencia){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $query = "INSERT INTO equipos (create_by, codigo, description, orden, id_categoria, marca,  modelo, serie, estado, observaciones, id_almacen, ubicacion, frecuencia ) 
            VALUES ('$id_user','$codigo', '$description',$orden, $categoria, '$marca', '$modelo', '$serie', '$estado','$observaciones', $almacen, '$ubicacion', $frecuencia)";

        try {
            $exc_query = $con->query($query);
            return '1';
        } catch (\Throwable $th) {
            return '0';
        }
    

    }

    public function edit($id,$id_user, $codigo, $description, $orden = 0, $categoria, $marca, $modelo, $serie, $estado, $observaciones = "N/A", $almacen, $ubicacion, $frecuencia){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $modify_date = date("Y-m-d :His");

        $query = "UPDATE equipos SET modify_date= '$modify_date', modify_by = '$id_user', codigo = '$codigo', description = '$description', 
        orden=$orden, id_categoria= $categoria, marca='$marca',  modelo= '$modelo', serie='$serie', estado='$estado', 
        observaciones='$observaciones', id_almacen=$almacen, ubicacion='$ubicacion', frecuencia=$frecuencia WHERE id = $id ";

        try {
            $exc_query = $con->query($query);
            return '1';
        } catch (\Throwable $th) {
            return '0';
        }
    
    }

    public function list(){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT * from equipos where delete_date is null order by id desc";
        $exc_query = mysqli_query($con, $query);

       return $exc_query;
    }
    public function filter($codigo, $nombre, $marca, $modelo){
        include("kon.php");
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT * from equipos 
        where 
        codigo like '%$codigo%'
        and description like '%$nombre%'
        and marca like '%$marca%'
        and modelo like '%$modelo%'
        and delete_date is null order by id desc";
        $exc_query = mysqli_query($con, $query);

       return $exc_query;
    }

    public function find($id){
        $conexion = new Kon();

        $con = $conexion->conn();

        $query = "SELECT * FROM equipos WHERE id=$id";
        $exce = $con->query($query);
        $equipo = mysqli_fetch_assoc($exce);

        return $equipo;
        
    }
}
?>