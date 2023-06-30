<?php
include("plantilla/menu_top.php");
?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Actividades para el equipo: BB003</h3>
    <div class="formularios">
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="" placeholder="Buscar actividad">
            </div>
            <div class="col-md-6">
                <button class = "btn btn-success float-right mb-3">Agregar todos</button>
            </div>
        </div>
       
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Actividades</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">0014</th>
      <td>Limpieza de filtros</td>
      <td>
        <button class="btn btn-info">Agregar</button>
      </td>
    </tr>
    <tr>
      <th scope="row">0012</th>
      <td>Carcazas y areas circundantes</td>
      <td>
        <button class="btn btn-info">Agregar</button>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</div>
