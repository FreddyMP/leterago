<?php
include("plantilla/menu_top.php");
?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Reportes de mantenimiento</h3>
    <div class="formularios">
      <div class="col-md-12 mb-3">
        <div class="row">
        <div class="col-md-3">
            <input class="form-control" type="text" name="" placeholder="Codigo">
          </div>
          <div class="col-md-3">
            <input class="form-control" type="text" name="" placeholder="Nombre">
          </div>
          <div class="col-md-4">
            <input class="form-control" type="date" name="">
          </div>
          <div class="col-md-2">
            <input class="btn btn-success col-md-12" type="submit" name="" value="Buscar" placeholder="Buscar reporte">
          </div>
        </div>
      </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Ubicacion</th>
      <th scope="col">Fecha</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">FOR-106</th>
      <td>Manejadora de agua helada</td>
      <td>Produccion</td>
      <td>20/10/2023</td>
      <td>
            <a href="ver_programa.php"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-info">Exportar</button>
      </td>
    </tr>
    <tr>
      <th scope="row">FOR-136</th>
      <td>Bomba Dispensadora de combustible</td>
      <td>Devoluciones</td>
      <td>04/10/2023</td>
      <td>
            <a href="ver_programa.php"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-info">Exportar</button>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</div>
