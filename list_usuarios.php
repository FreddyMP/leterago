<?php
    include("plantilla/menu_top.php");
    $lista_usuarios = $con->conectar();
    $query = "SELECT * from usuarios where delete_date is null  and create_by <>0";
    $exc_usuarios = mysqli_query($lista_usuarios,$query);

?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
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
            <button class="btn btn-danger">Eliminar</button>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
    </div>
</div>
