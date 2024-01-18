<?php
    include("plantilla/menu_top.php"); 
    include("model/categorias.php");

    $Categorias_instance = new Categorias();

    $id = $_GET["id"];

    $categorias = $Categorias_instance->find($id);

?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
<?php
    if(isset($_GET["error_create"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error de eliminacion!</h4>
      <p>No puede eliminar roles que esten vinculados a usuarios<hr>
      <p class="mb-0">Si el usuario no existe y el error persiste escriba a su suplidor</p>
    </div>

<?php
    }
?>
    <h3>Editar categoria</h3>
    <div class="formularios">
        <form action="controllers/editar_categorias.php" method="post">
            <div class="row">
                <div class="col-md-4 mt-3">
                    <input class="form-control" name="codigo" value="<?php echo $categorias['codigo'] ?>" type="text" placeholder="Codigo" required>
                </div>
                <input class="form-control" name="id" value="<?php echo $categorias['id'] ?>" type="hidden" placeholder="Codigo" required>

                <div class="col-md-8 mt-3">
                    <input class="form-control" name="description" value="<?php echo $categorias['description'] ?>" type="text" placeholder="Descripcion" required>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>