<?php
    include("plantilla/menu_top.php");
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Equipos</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Actividades</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">BB001</th>
      <td>Bomba de agua helada</td>
      <td>Revision electrica, Revision del drenaje</td>
      <td>
            <a href="edit_usuario.php?id="><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-danger">Eliminar</button>
      </td>
    </tr>
    <tr>
      <th scope="row">AA001</th>
      <td>Aire Acondicionado split pared</td>
      <td>Limpieza de filtro, Revision del drenaje</td>
      <td>
            <a href="edit_usuario.php?id"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-danger">Eliminar</button>
      </td>
    </tr>
 
  </tbody>
</table>
    </div>
</div>
