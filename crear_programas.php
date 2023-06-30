<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
    <h3>Crear nuevo programa</h3>
    <div class="formularios">
        <form action="programa_detalle..php" method="post">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <input class="form-control" name="codigo" type="text" placeholder="Doc. relacionado">
                </div>
                <div class="col-md-8 mb-4">  
                </div>
                <div class="col-md-2 mb-4">
                    <input class="form-control" name="descripcion" type="text" placeholder="Doc. No.">
                </div>
                <div class="col-md-2 mb-4">
                    <input class="form-control" name="version" type="text" placeholder="Version">
                </div>
                <div class="col-md-8 mb-4">
                    <input class="form-control" name="descripcion" type="text" placeholder="Descripcion">
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>