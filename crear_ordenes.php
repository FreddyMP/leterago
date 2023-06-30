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
    <h3>Crear orden</h3>
    <div class="formularios">
        <form action="participacion_orden.php" method="post">
            <h5>Datos de la solicitud</h5>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="username" type="text" placeholder="Documento No." required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="password" type="text" placeholder="Version" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="name" type="text" placeholder="Doc. relacionado" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="lastname" type="text" placeholder="No. de Orden" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="lastname" type="date" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="lastname" type="time" required>
                </div>
                <div class="col-md-12 mt-3">
                    <input class="form-control" name="name" type="text" placeholder="Solicitado por" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="name" type="text" placeholder="Departamentos" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="name" type="text" placeholder="Area o equipo" required>
                </div>
                <div class="col-md-12 mt-3">
                    <input class="form-control" name="name" type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="name" type="text" placeholder="Ubicacion" required>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="" id="">
                        <option value="1">Prioridad media</option>
                        <option value="1">Prioridad Alta</option>
                        <option value="1">Prioridad Baja</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <textarea name="" class="form-control" id="" placeholder="Descripcion" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mt-3">
                    <textarea name="" class="form-control" id="" placeholder="Notas:    " cols="30" rows="10"></textarea>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>


    </div>
</div>