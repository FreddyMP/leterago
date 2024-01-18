<?php
    include("plantilla/menu_top.php");
    include("model/ubicaciones.php");
    $ubicaciones_instance = new Ubicaciones();
    $exc_ubicaciones = $ubicaciones_instance->list();
?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido">
    <br>
    <h3>Ubicaciones</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($row = mysqli_fetch_assoc($exc_ubicaciones)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["id"] ?></th>
      <td><?php echo $row["description"]?></td>
      <td>
            <a href="edit_ubicacion.php?id=<?php echo $row['id']?>"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']?>">Eliminar</button>
      </td>
    </tr>


<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar ubicacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Esta seguro que desea eliminar la ubicacion: <?php echo $row["description"]?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a  href = "controllers/delete_ubicaciones.php?id=<?php echo $row['id']?>" type="button" class="btn btn-danger">Borrar</a>
      </div>
    </div>
  </div>
</div>
    <?php
      }
    ?>

  </tbody>
</table>
    </div>
</div>
