<?php
    include("plantilla/menu_top.php");
    $rol=$_POST["id_rol"];
    $description_rol=$_POST["description_rol"];
?>


<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
    <h3>Asignar permisos</h3>
    <div class="formularios">
        <form action="../backend/controllers/create_rol.php" method="post">
            <div class="row">
                <div class="col-md-12">
                    <input class="form-control" name="descripcion" type="text" value="Administrador" placeholder="Descripcion">
                    <input class="form-control" name="rol" type="text" value="<?php echo $rol ?>" placeholder="Descripcion">
                </div>
                <div class="col-md-12">
                    <input class="form-control" name="descripcion" type="text" placeholder="Descripcion">
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>