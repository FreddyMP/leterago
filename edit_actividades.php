<?php
    include("plantilla/menu_top.php"); 
    include("model/actividades.php");

    $actividades_instance = new Actividades();

    $id= $_GET["id"];

    $activiades = $actividades_instance->find($id);
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
<?php
    if(isset($_GET["error_edit"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error al editar!</h4>
      <p>No pueden haber actividades con el mismo nombre<hr>
      <p class="mb-0">Si la actividad no existe y el error persiste escriba al administrador</p>
    </div>

<?php
    }
?>
    <h3>Editar actividad</h3>
    <div class="formularios">
        <form action="controllers/editar_actividades.php" method="post">
            <div class="row">
            <div class="col-md-12 mt-3">
                    <input class="form-control" name="id" value="<?php echo $activiades["id"] ?>" type="hidden" placeholder="Descripcion" required>
                </div>
                <div class="col-md-12 mt-3">
                    <input class="form-control" name="description" value="<?php echo $activiades["description"] ?>" type="text" placeholder="Descripcion" required>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>