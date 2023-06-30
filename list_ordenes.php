<?php
include("plantilla/menu_top.php");
?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Ordenes</h3>
    <div class="formularios">
    <div class="col-md-12 mb-3">
        <div class="row">
          <div class="col-md-6">
            <input class="form-control" type="text" name="" placeholder="Buscar reporte por nombre">
          </div>
          <div class="col-md-3">
            <input class="form-control" type="date" name="">
          </div>
          <div class="col-md-3">
            <input class="btn btn-success" type="submit" name="" value="Buscar" placeholder="Buscar">
          </div>
        </div>
      </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No. de orden</th>
      <th scope="col">Solicitado por</th>
      <th scope="col">Departamento</th>
      <th scope="col">Fecha</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">OT-ALM-039-2023</th>
      <td>Wellignton Cuevas</td>
      <td>Distribucion</td>
      <td>10/09/2023</td>
      <td>
            <a href="ver_programa.php"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-info">Exportar</button>
      </td>
    </tr>
    <tr>
      <th scope="row">OT-INGO-039-2023</th>
      <td>Rafael Alcantara</td>
      <td>Calidad</td>
      <td>03/05/2023</td>
      <td>
            <a href=""><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-info">Exportar</button>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</div>
