<?php
    include("plantilla/menu_top.php"); 
    include("model/ubicaciones.php");

    $id = $_GET["id"];
    $Ubicaciones_instance = new Ubicaciones();

    $ubicaciones = $Ubicaciones_instance->find($id);

?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
<?php
    if(isset($_GET["error_edit"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error de creacion!</h4>
      <p>Recuerda los nombres de usuarios no pueden repetirse<hr>
      <p class="mb-0">Si el usuario no existe y el error persiste escriba a su suplidor</p>
    </div>

<?php
    }
?>
    <h3>Editar ubicacion</h3>
    <div class="formularios">
        <form action="controllers/editar_ubicacion.php" method="post">
            <div class="row">
                <div class="col-md-8 mt-3">
                <input  type="hidden" name="id" value="<?php echo $ubicaciones["id"] ?>"  required>

                    <input class="form-control" name="description" value="<?php echo $ubicaciones["description"] ?>"  type="text" placeholder="Descripcion" required>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>