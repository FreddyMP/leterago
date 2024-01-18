<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
<?php
    if(isset($_GET["error_create"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error al crear!</h4>
      <p>No puede crear categorias con el mismo codigo<hr>
      <p class="mb-0">Si la categoria no existe y el error persiste escriba al administrador</p>
    </div>

<?php
    }
?>
    <h3>Crear actividades</h3>
    <div class="formularios">
        <form action="controllers/create_actividades.php" method="post">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <input class="form-control" name="description" type="text" placeholder="Descripcion" required>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>