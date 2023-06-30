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
    <h3>Crear equipo</h3>
    <div class="formularios">
        <form action="equipo_detalle.php" method="post">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <input class="form-control" name="username" type="text" placeholder="Descripcion" required>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="" id="">
                        <option value="">Bombas</option>
                        <option value="">Aires acondicionado</option>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                <select class="form-control" name="" id="">
                        <option value="1">Almacen 1</option>
                        <option value="2">Almacen 2</option>
                        <option value="3">Almacen 3</option>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                <select class="form-control" name="" id="">
                        <option value="1">Produccion</option>
                        <option value="2">Devoluciones</option>
                        <option value="3">Calidad</option>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="" id="">
                        <option value="1">Mensual</option>
                        <option value="2">Bimensual</option>
                        <option value="3">Trimensual</option>
                        <option value="4">Cuatrimestral</option>
                        <option value="5">Semestral</option>
                        <option value="6">Anual</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <hr>
                    <input name="lastname" type="checkbox"> Para ordenes
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>