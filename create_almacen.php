<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
<?php
    $lista_roles = $con->conectar();
    $query = "SELECT * from rol where delete_date is null and create_by <> 0 ";
    $exc_query = mysqli_query($lista_roles, $query);
    if(isset($_GET["error_create"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error de creacion!</h4>
      <p>Recuerda los nombres de usuarios no pueden repetirse<hr>
      <p class="mb-0">Si el usuario no existe y el error persiste escriba a su suplidor</p>
    </div>

<?php
    }
?>
    <h3>Crear almacen</h3>
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