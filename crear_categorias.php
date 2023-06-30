<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>

    <h3>Crear categoria</h3>
    <div class="formularios">
        <form action="controllers/create_almacen.php" method="post">
            <div class="row">
                <div class="col-md-4 mt-3">
                    
                    <input class="form-control" name="codigo" type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-8 mt-3">
                    <input class="form-control" name="description" type="text" placeholder="Descripcion" required>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>