<?php
    include("plantilla/menu_top.php");

    $usuarios = $Users_instance->list();

    $exc_usuarios = $usuarios;          

?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido">
    <br>
    <h3>Usuarios</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Usuario</th>
      <th scope="col">Nombre</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($row = mysqli_fetch_assoc($exc_usuarios)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["id"]?></th>
      <td><?php echo $row["username"] ?></td>
      <td><?php echo $row["name"]?></td>
      <td>
        <a href="edit_usuario.php?id=<?php echo $row['id']?>"><button class="btn btn-warning">Editar</button></a>
        <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $row["id"]?>">Eliminar</button>
      </td>
    </tr>
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row["id"]?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $row["id"]?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel <?php echo $row["id"]?>">Eliminar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro que deseas eliminar a: <?php echo $row["username"] ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="controllers/delete_usuario.php?id=<?php echo $row['id']?>">
          <button type="button" class="btn btn-danger">
            Borrar
          </button>
        </a>
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

