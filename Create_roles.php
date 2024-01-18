<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
    <h3>Crear nuevo rol</h3>
    <div class="formularios">
        <form action="controllers/create_rol.php" method="post">
            <div class="row">
                <div class="col-md-12">
                    <input class="form-control" name="descripcion" type="text" placeholder="Descripcion">
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>