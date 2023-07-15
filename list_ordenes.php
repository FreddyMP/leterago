<?php
include("plantilla/menu_top.php");
include("model/ordenes.php");
$Ordenes_instance = new Ordenes();
$ordenes = $Ordenes_instance->list();
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
    <?php
      while($row = mysqli_fetch_assoc($ordenes)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["orderNum"] ?></th>
      <td><?php echo $row["solicitadoPor"] ?></td>
      <td><?php echo $row["departamento"] ?></td>
      <td><?php echo $row["fecha"] ?></td>
      <td>
            <a href="edit_orden.php?id=<?php echo $row["id"] ?>"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-info">Exportar</button>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
    </div>
</div>
