<?php
    include("plantilla/menu_top.php"); 
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
    <h3>Editar programa: RPG-005</h3>
    <div class="formularios">
        <form action="programa_detalle..php" method="post">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <input class="form-control" name="codigo" type="text" disabled placeholder="Doc. relacionado">
                </div>
                <div class="col-md-8 mb-4">  
                </div>
                <div class="col-md-2 mb-4">
                    <input class="form-control" name="descripcion" type="text" placeholder="Doc. No.">
                </div>
                <div class="col-md-2 mb-4">
                    <input class="form-control" name="version" type="text" placeholder="Version">
                </div>
                <div class="col-md-8 mb-4">
                    <input class="form-control" name="descripcion" type="text" placeholder="Descripcion">
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>

<div class="Container">
    <br>
    <h3>Detalles de la programacion</h3>
    <div class="formularios">
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="" placeholder="Buscar equipo">
            </div>
            <div class="col-md-6">
                <button class = "btn btn-danger float-right mb-3">Quitar todos</button>
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
        <button class="btn btn-warning">Quitar</button>
      </td>
    </tr>
    <tr>
      <th scope="row">AA0012</th>
      <td>Equipo de aire acondicionado (almacen2)</td>
      <td>Limpieza de evaporador, Carcazas y areas circundantes</td>
      <td>Mensual</td>
      <td>
        <button class="btn btn-warning">Quitar</button>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</div>


