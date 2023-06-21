<?php
    include("plantilla/menu_top.php");  
    $lista = new Conexion();

    $con = $lista->conectar();

    $id = $_GET["id"];

    $query = "SELECT * from rol where id = $id and delete_date is null";
    $exc_query = mysqli_query($con,$query);

    $query_permisos = "SELECT * from rolpermisos where id_Rol = $id";
    $exc_query_permisos = mysqli_query($con,$query_permisos);

    $rol = mysqli_fetch_assoc($exc_query);
    $rol_permisos = mysqli_fetch_assoc($exc_query_permisos);
    $rol_description = $rol["description"];
   
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
    <h3>Editar rol</h3>
    <div class="formularios">
        <form action="controllers/editar_rol.php" method="post">
            <div class="row">
                <div class="col-md-12">
                    <input class="form-control" name="descripcion" value="<?php echo $rol_description ?>" type="text" placeholder="Descripcion">
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="usuarios" id="">
                    <?php
                            if($rol_permisos["Modulo_Usuarios"]== '1')
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Crear usuarios
                    <select class="form-control" name="crear_usuarios" id="">
                    <?php
                            if($rol_permisos["Crear_Modulo_Roles"]== '1')
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <div class="col-md-3 pt-3">
                    Editar usuarios
                    <select class="form-control" name="editar_usuarios" id="">
                    <?php
                            if($rol_permisos["Editar_Modulo_Usuarios"]== '1')
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Eliminar usuarios
                    <select class="form-control" name="eliminar_usuarios" id="">
                    <?php
                            if($rol_permisos["Eliminar_Modulo_Usuarios"]== '1')
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Roles
                    <select class="form-control" name="roles" id="">
                        <?php
                            if($rol_permisos["Modulo_Roles"]== '1')
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Crear roles
                    <select class="form-control" name="crear_roles" id="">
                    <?php
                            if($rol_permisos["Crear_Modulo_Roles"]== 1)
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Editar roles
                    <select class="form-control" name="editar_roles" id="">
                    <?php
                            if($rol_permisos["Editar_Modulo_Roles"]== 1)
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Eliminar roles
                    <select class="form-control" name="eliminar_roles" id="">
                    <?php
                            if($rol_permisos["Eliminar_Modulo_Roles"]== 1)
                            {
                                ?>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                <?php
                            }else{
                                ?>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Usuarios
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>