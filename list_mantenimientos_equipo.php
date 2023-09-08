<?php
include("plantilla/menu_top.php");
include('model/mantenimiento.php');

$mantenimientos_instance = new Mantenimiento();

$mantenimientos = $mantenimientos_instance->list();

?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>AA0012: Aire acondicionado inverte</h3>
    <div class="formularios">
      <div class="col-md-12 mb-3">
        <div class="row">
        <div class="col-md-3">
          Desde
            <input class="form-control" type="text" name="" placeholder="Codigo">
          </div>
          <div class="col-md-4">
            Hasta
            <input class="form-control" type="date" name="">
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-6 mt-4">
                <input class="btn btn-success col-md-12 " type="submit" name="" value="Buscar">
              </div>
              <div class="col-md-6 mt-4">
                <input class="btn btn-info col-md-12" type="submit" name="" value="Exportar">
              </div>
            </div>
          </div>
        </div>
      </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Doc. No</th>
      <th scope="col">Documento. Relacionado</th>
      <th scope="col">Fecha planificacion</th>
      <th scope="col">Fecha</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td>Aire acondicionado inverte</td>
      <td>Administracion</td>
      <td>2023-07-12</td>
      <td>
            <a href="ver_programa.php"><button class="btn btn-warning">Ver mas</button></a>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</div>
