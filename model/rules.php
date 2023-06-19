<?php
include("kon.php");
class Rules{

    public function create_rule(String $descripcion, String $creado_por = "Super_admin"){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "INSERT INTO  rol(description, create_by) values ('$descripcion','$creado_por')";
        $Insert_result = false;
        try {
            $exc_query = mysqli_query($con, $query);
            $Insert_result = true;
        } catch (\Throwable $th) {
            $Insert_result = false;
        }

        return $query;
    }

    public function permisos_default(){
        $conectar = new Kon();
        $con = $conectar->conn();
        $last_id=0;

        $query = "SELECT id from rol order by id desc limit 1";
        $exc_query = mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($exc_query)){
            $last_id = $row["id"];
        }

        $Insert_result = false;
        $query_insert = "INSERT INTO rolpermisos(`id_Rol`, `Modulo_Ordenes`, `Crear_Modulo_Ordenes`, `Editar_Modulo_Ordenes`, `Eliminar_Modulo_Ordenes`, `Modulo_Usuarios`, `Crear_Modulo_Usuarios`, `Editar_Modulo_Usuarios`, `Eliminar_Modulo_Usuarios`, `Modulo_Roles`, `Crear_Modulo_Roles`, `Editar_Modulo_Roles`, `Eliminar_Modulo_Roles`, `Modulo_ProgramaMantenimiento`, `Crear_Modulo_ProgramaMantenimiento`, `Edita_Modulo_ProgramaMantenimiento`, `Eliminar_Modulo_ProgramaMantenimiento`, `Frecuencias`, `Crear_Frecuencias`, `Editar_Frecuencias`, `Eliminar_Frecuencias`, `Actividades`, `Crear_Actividades`, `Editar_Actividades`, `Eliminar_Actividades`, `Equipos`, `Crear_Equipos`, `Editar_Equipos`, `Eliminar_Equipos`, `Categorias`, `Crear_Categorias`, `Editar_Categorias`, `Eliminar_Categorias`) VALUES ('$last_id','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1')";

        try {
            $exc_query = mysqli_query($con, $query_insert);
            $Insert_result = true;
        } catch (\Throwable $th) {
            $Insert_result = false;
        }
        
        $next_id = $last_id + 1;

        return $Insert_result;
    }

    public function List(){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT id, description from rol order by id desc ";
        $exc_query = mysqli_query($con, $query);

       return $exc_query;
        

    }

    public function update($id, $roles, $crear_rol, $editar_rol, $eliminar_rol){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "UPDATE rolpermisos set Modulo_Roles = $roles, Crear_Modulo_Roles =  $crear_rol, Editar_Modulo_Roles = $editar_rol, Eliminar_Modulo_Roles = $eliminar_rol where id_rol = $id";
        $Insert_result = false;
        try {
            $exc_query = mysqli_query($con, $query);
            $Insert_result = true;
        } catch (\Throwable $th) {
            $Insert_result = false;
        }

        return $Insert_result;
    }
}
?>