<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
<?php
    $id = $_GET["id"];
    $cone_almacenes = $con->conectar();
    $query = "SELECT * from almacenes where id= $id";
    $exc_Almacenes = mysqli_query($cone_almacenes, $query);

    $almacenes = mysqli_fetch_assoc($exc_Almacenes);
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