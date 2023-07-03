<?php

class Rules{

    public function create_rule(String $descripcion, String $creado_por = "Super_admin"){
        include("kon.php");
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
        include("kon.php");
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

    public function list(){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT id, description from rol where id <> 1 and delete_date is null order by id desc ";
        $exc_query = mysqli_query($con, $query);

       return $exc_query;
    }

    public function update($descrition, $id, $roles, $crear_rol, $editar_rol, $eliminar_rol, $usuarios, $crear_usuarios, $editar_usuarios, $eliminar_usuarios){
        include("kon.php");
        $conectar = new Kon();
        $con = $conectar->conn();
        
        $query_rol = "UPDATE rol set description = '$descrition' where id = $id";
        $query_permisos = "UPDATE rolpermisos set 
        Modulo_Roles = $roles, Crear_Modulo_Roles =  $crear_rol, Editar_Modulo_Roles = $editar_rol, Eliminar_Modulo_Roles = $eliminar_rol,
        Modulo_Usuarios = $usuarios, Crear_Modulo_Usuarios =  $crear_usuarios, Editar_Modulo_Usuarios = $editar_usuarios, Eliminar_Modulo_Usuarios = $eliminar_usuarios
        where id_rol = $id";

        $Insert_result = false;

        try {
            $exc_query = mysqli_query($con, $query_permisos);
            $exc_query = mysqli_query($con, $query_rol);
            $Insert_result = true;
        } catch (\Throwable $th) {
            $Insert_result = false;
        }

        return $Insert_result;
    }

    public function find($id){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT id, description FROM rol where id = $id ";
        $exc_query = mysqli_query($con, $query);
                        
       return $exc_query;
    }

    public function find_edit($id){
        $conectar = new Kon();
        $con = $conectar->conn();

        $query = "SELECT * from rol inner join rolpermisos on rolpermisos.id_Rol = rol.id where rol.id = $id ";
        $exc_query = mysqli_query($con, $query);

        $Rules = mysqli_fetch_assoc($exc_query);
                        
       return $Rules;
    }

    public function delete($id, $id_username){
        include("kon.php");

        $conexion = new Kon();
        $con = $conexion->conn();

        $query_usuarios_vinculados = "SELECT count(*) as Num FROM usuarios WHERE id_rol = $id and delete_date is null";  
        
        $exc_query_find_user = $con->query($query_usuarios_vinculados);

        $count_db = mysqli_fetch_assoc($exc_query_find_user);

        $count = $count_db["Num"];

        if($count == 0){
            $delete_date = date("Y-m-d :His");
            $query_delete = "UPDATE rol set delete_date = '$delete_date', delete_by = '$id_username' where id = $id";
            $exc_query_delete = $con->query($query_delete);
             return "1";
        }else{
            return "0";
        }

       
    }
}

?>