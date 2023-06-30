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
    <h3>Crear mantenimiento</h3>
    <div class="formularios">
        <form action="participacion_orden.php" method="post">
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
                    <input class="form-control" name="lastname" type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="lastname" type="date">
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="" id="">
                        <option value="">Produccion</option>
                        <option value="">Distribucion</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                <select class="form-control" name="" id="">
                        <option value="">BB001| Bomba de agua helada</option>
                        <option value="">AA001| Aire acondicionado split pared</option>
                    </select>
                </div>
            </div>
                <h3 class="mt-3 mb-3">Limpieza general</h3>
                <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Actividad</th>
      <th scope="col">  OK</th>
      <th scope="col">  N/A</th>
      <th scope="col">  R</th>
      <th scope="col">Observaciones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Lavado de filtros</th>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td>
        <input class="form-control" type="text" name="" id="">
      </td>
    </tr>
    <tr>
      <th scope="row">Lavado de filtros</th>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td>
        <input class="form-control" type="text" name="" id="">
      </td>
    </tr>
  </tbody>
</table>
<h3 class="mt-3 mb-3">Revision del sistema electrico y mecanico</h3>
                <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Actividad</th>
      <th scope="col">  OK</th>
      <th scope="col">  N/A</th>
      <th scope="col">  R</th>
      <th scope="col">Observaciones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Lavado de filtros</th>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td>
        <input class="form-control" type="text" name="" id="">
      </td>
    </tr>
    <tr>
      <th scope="row">Lavado de filtros</th>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td><input  type="checkbox" name=""  id=""></td>
      <td>
        <input class="form-control" type="text" name="" id="">
      </td>
    </tr>
  </tbody>
</table>
<textarea class="form-control" placeholder="Observaciones generales"></textarea>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">

        </form>


    </div>
</div>