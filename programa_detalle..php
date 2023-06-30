<?php
include("plantilla/menu_top.php");
?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Detalles de la programacion: RPG-005</h3>
    <div class="formularios">
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="" placeholder="Buscar equipo">
            </div>
            <div class="col-md-6">
                <button class = "btn btn-success float-right mb-3">Agregar todos</button>
            </div>
        </div>
       
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Equipo</th>
      <th scope="col">Actividades</th>
      <th scope="col">Frecuencia</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">AA0014</th>
      <td>Equipo de aire acondicionado  split pared (almacen1)</td>
      <td>Limpieza de filtros, Carcazas y areas circundantes</td>
      <td>Mensual</td>
      <td>
        <button class="btn btn-info">Agregar</button>
      </td>
    </tr>
    <tr>
      <th scope="row">AA0012</th>
      <td>Equipo de aire acondicionado (almacen2)</td>
      <td>Limpieza de evaporador, Carcazas y areas circundantes</td>
      <td>Mensual</td>
      <td>
        <button class="btn btn-info">Agregar</button>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</div>
