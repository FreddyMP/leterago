<?php
    include("plantilla/menu_top.php");
    include("model/equipos.php");

    $equipos_instance = New Equipos();
    $exc_equipos = $equipos_instance->list();
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Equipos</h3>
    <div class="formularios">
    <div class="col-md-12 mb-4">
        <div class="row">
        <div class="col-md-2">
            <input class="form-control" type="text" name="" placeholder="Codigo">
          </div>
          <div class="col-md-3">
            <input class="form-control" type="text" name="" placeholder="Nombre">
          </div>
          <div class="col-md-2">
            <input class="form-control" type="text" name="" placeholder="Marca">
          </div>
          <div class="col-md-2">
            <input class="btn btn-success col-md-12 float-right" type="submit" name="" value="Buscar" placeholder="Buscar reporte">
          </div>
        </div>
      </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Marca</th>
      <th scope="col">Modelo</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      while($equipos = mysqli_fetch_assoc($exc_equipos)){

    ?>
    <tr>
      <th scope="row"><?php echo $equipos["codigo"] ?></th>
      <td><?php echo $equipos["description"]?></td>
      <td><?php echo $equipos["marca"]?></td>
      <td><?php echo $equipos["modelo"]?></td>
      <td>
            <a href="edit_equipo.php?id=<?php echo $equipos["id"] ?>"><button class="btn btn-warning"> <small>Editar</small></button></a>
            <button class="btn btn-danger"><small>Eliminar</small></button>
      </td>
    </tr>
    <?php
      }
    ?>
 
  </tbody>
</table>
    </div>
</div>
