<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
    <h3>Crear nuevo programa</h3>
    <div class="formularios">
        <form action="controllers/create_programa.php" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    Doc. RPG
                    <input class="form-control" name="doc_no" type="text" placeholder="Doc. relacionado">
                </div>
                <div class="col-md-4 mb-3">
                    Inicio
                    <input class="form-control" name="fecha_ini" type="date" >
                </div>
                <div class="col-md-4 mb-3">
                    Finalizacion
                    <input class="form-control" name="fecha_fin" type="date" >
                </div>
                <div class="col-md-2 mb-4">
                    Doc FOR
                    <input class="form-control" name="doc_relacionado" type="text" placeholder="Doc. No.">
                </div>
                <div class="col-md-2 mb-4">
                    Version
                    <input class="form-control" name="version" type="text" placeholder="Version">
                </div>
                <div class="col-md-8 mb-4">
                    Descripcion de la planificacion
                    <input class="form-control" name="descripcion" type="text" placeholder="Descripcion">
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>