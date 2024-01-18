<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>

    <h3>Crear ubicacion</h3>
    <div class="formularios">
        <form action="controllers/create_ubicaciones.php" method="post">
            <div class="row">
                <div class="col-md-8 mt-3">
                    <input class="form-control" name="description" type="text" placeholder="Descripcion" required>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>