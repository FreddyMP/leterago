<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
    <h3>Agregar participantes</h3>
    <div class="formularios">
        <div class="row">
            <div class="col-md-3">
                <input class="form-control" type="text" placeholder= "Nombre del participante">
            </div>
            <div class="col-md-3">
                <input class="form-control" type="date" >
            </div>
            <div class="col-md-3">
                <input class="form-control" type="time">
            </div>
            <div class="col-md-3">
                <button class="btn btn-info">Agregar</button>
            </div>
        </div>
        <h5 class="mt-3 mb-3">Participantes</h5>
        <div>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Fecha</th>
      <th scope="col">Hora</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Manuel de jesus</th>
      <td>10/09/2023</td>
      <td>02:30</td>
      <td>
            <a href="ver_programa.php"><button class="btn btn-warning">Quitar</button></a>
      </td>
    </tr>
    <tr>
      <th scope="row">Jesus Manuel</th>
      <td>10/10/2023</td>
      <td>04:10</td>
      <td>
            <a href="ver_programa.php"><button class="btn btn-warning">Quitar</button></a>
      </td>
    </tr>
  </tbody>
</table>
        </div>
        
    </div>
</div>