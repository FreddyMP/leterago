<?php
    include("plantilla/menu_top.php"); 
    include("model/almacenes.php");

    $id = $_GET["id"];
    $Almacenes_instance = new Almacenes();

    $almacenes = $Almacenes_instance->find($id);

?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
<?php
    if(isset($_GET["error_borrado"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error de creacion!</h4>
      <p>Recuerda los nombres de usuarios no pueden repetirse<hr>
      <p class="mb-0">Si el usuario no existe y el error persiste escriba a su suplidor</p>
    </div>

<?php
    }
?>
    <h3>Editar almacen</h3>
    <div class="formularios">
        <form action="controllers/editar_almacen.php" method="post">
            <div class="row">
                <div class="col-md-4 mt-3">
                    <input class="form-control" name="codigo" value="<?php echo $almacenes["codigo"] ?>"  type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-8 mt-3">
                <input  type="hidden" name="id" value="<?php echo $almacenes["id"] ?>"  required>

                    <input class="form-control" name="description" value="<?php echo $almacenes["description"] ?>"  type="text" placeholder="Descripcion" required>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>