<?php
    include_once("../model/equipos.php");

    $equipos_instance = New Equipos();
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $marca  = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $exc_equipos = $equipos_instance->filter($codigo, $nombre, $marca, $modelo);
?>



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
