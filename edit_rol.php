<?php
    include("plantilla/menu_top.php");  
    include("model/rules.php");

    $rol_instance = new Rules();

    $id_rol = $_GET["id"];

    $rol_permisos = $rol_instance->find_edit($id_rol);
?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
    <h3>Editar rol</h3>
    <div class="formularios">
        <form action="controllers/editar_rol.php" method="post">
            <div class="row">
                <div class="col-md-12">
                    <input class="form-control" name="descripcion" value="<?php echo $rol_permisos["description"]?>" type="text" placeholder="Descripcion">
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
                            if($rol_permisos["Crear_Modulo_Usuarios"]== '1')
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
                <input type="hidden" value="<?php echo $id_rol ?>" name="id">
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
                    Ubicaciones
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Crear Ubicaciones
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Editar Ubicaciones
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Eliminar Ubicaciones
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Equipos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Crear Equipos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Editar Equipos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Eliminar Equipos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Actividades
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Crear Actividades
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Editar Actividades
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Eliminar Actividades
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Agregar actividades a equipos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Quitar actividades de equipos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
      
                <div class="col-md-3 pt-3">
                    Reportes de equipos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Reportes de mantenimientos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Ver mantenimientos
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Ordenes
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Crear Ordenes
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Editar ordenes
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Eliminar ordenes
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Programas
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Crear Programas
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Editar Programas
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Agregar o quitar equipos al Programa
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Calendario
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Asignar fecha
                    <select class="form-control" name="" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    Editar asignacion de fecha
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