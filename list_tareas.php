<?php
include("plantilla/menu_top.php");
include("model/programas.php");
$programa_instance = new Programas();

$programa_exc = $programa_instance->list_header();
?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Tareas pendientes</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Equipo</th>
      <th scope="col">Fecha</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <th scope="row">AA0010</th>
      <td>Aire acondicionado testing 2</td>
      <td>2023-07-10</td>
      <td>
          <a href="crear_mantenimiento.php"><button class="btn btn-danger mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">AA0012</th>
      <td>Aire acondicionado testing</td>
      <td>2023-07-22</td>
      <td>
          <a href="crear_mantenimiento.php"><button class="btn btn-info mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">BA0012</th>
      <td>Bomba de agua helada</td>
      <td>2023-07-22</td>
      <td>
          <a href="crear_mantenimiento.php"><button class="btn btn-info mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">MC0007</th>
      <td>Palet Eléctrico</td>
      <td>2023-07-22</td>
      <td>
          <a href="crear_mantenimiento.php"><button class="btn btn-info mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">MC0006</th>
      <td>Stockpicker</td>
      <td>2023-07-25</td>
      <td>
          <a><button class="btn btn-dark mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">MC0002</th>
      <td>Montacargas Eléctrico</td>
      <td>2023-07-25</td>
      <td>
          <a><button class="btn btn-dark mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">UP0005</th>
      <td>UPS</td>
      <td>2023-07-25</td>
      <td>
          <a><button class="btn btn-dark mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">MC0007</th>
      <td>Palet Eléctrico</td>
      <td>2023-07-26</td>
      <td>
          <a><button class="btn btn-dark mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">MC0007</th>
      <td>Palet Eléctrico</td>
      <td>2023-07-26</td>
      <td>
          <a><button class="btn btn-dark mb-2">Realizar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">MC0007</th>
      <td>Palet Eléctrico</td>
      <td>2023-07-26</td>
      <td>
          <a><button class="btn btn-dark mb-2">Realizar</button></a>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</div>
