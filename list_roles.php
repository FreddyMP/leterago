<?php
    include("plantilla/menu_top.php");
    include("model/rules.php");
    $Roles_instance = new Rules();

    $Roles = $Roles_instance->list();
    $exc_roles = $Roles;          


?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Roles</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($row = mysqli_fetch_assoc($exc_roles)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["id"]?></th>
      <td><?php echo $row["description"] ?></td>
      <td>
            <a href="edit_rol.php?id=<?php echo $row['id']?>"><button class="btn btn-warning">Editar</button></a>
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
