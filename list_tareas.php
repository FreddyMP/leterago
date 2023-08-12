<?php
include("plantilla/menu_top.php");
include("model/calendario.php");
$calendario_instance = new Calendario();


$calendarios = $calendario_instance->list_ejecuciones();

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

  <?php
    while($row= mysqli_fetch_assoc($calendarios) ){

  ?>
  <tr>
      <th scope="row">AA0010</th>
      <td>Aire acondicionado testing 2</td>
      <td>2023-07-10</td>
      <td>
          <a href="crear_mantenimiento.php"><button class="btn btn-danger mb-2">Realizar</button></a>
      </td>
  </tr>
  <?php
    }
  ?>
   
  </tbody>
</table>
    </div>
</div>
