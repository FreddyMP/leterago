<?php
    include("plantilla/menu_top.php"); 
    include("model/Ordenes.php");
    include("model/ordenes_ejecutores.php");

    $ordenes_intance= new Ordenes();
    $id = $_GET["id"];

    $orden_details_instance = new Ordernes_ejecutores();
    $orden_details = $orden_details_instance->list($id);


?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido">
    <br>
    <h3>Agregar ejecutor</h3>
    <div class="formularios">
    <form action="controllers/add_ejecutor_orden.php" method="post">
        <div class="row">
            
            <div class="col-md-5  mb-3">
                <input type="hidden" name="id" value="<?php echo $id ?>" id="">
                <input  class="form-control" placeholder="Nombre del tecnico" type="text" name="ejecutor" id="">
            </div>
            <div class="col-md-3  mb-3">
                <input  class="form-control" type="date" name="fecha" id="">
            </div>
            <div class="col-md-2  mb-3">
                <input  class="form-control" type="time" name="hora_inicio" id="">
            </div>
            <div class="col-md-2  mb-3">
                <input  class="form-control" type="time" name="hora_fin" id="">
            </div>
            <div class="col-md-12">
                <button class = "btn btn-info col-md-4 float-right mb-3">Agregar</button>
            </div>
            
        </div>
        </form>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Personal tecnico</th>
      <th scope="col">Fecha</th>
      <th scope="col">Hora inicio</th>
      <th scope="col">Hora Fin </th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        while ($row = mysqli_fetch_assoc($orden_details)) {
    ?>
    <tr>
      <td><?php echo $row["realizado_por"] ?></td>
      <td><?php echo $row["fecha"] ?></td>
      <td><?php echo $row["horaIni"] ?></td>
      <td><?php echo $row["horaFin"] ?></td>
      <td>
        <a href="controllers/delete_equipo_actividad.php?id=<?php echo $row["id"] ?>&&id_equipo=<?php echo $id?>" class="btn btn-warning ">Quitar</a>
      </td>
    </tr>
    <?php
        }
    ?>
  </tbody>
</table>
    </div>
</div>