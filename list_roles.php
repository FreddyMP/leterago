<?php
    include("plantilla/menu_top.php");
    $lista = new Conexion();

    $con = $lista->conectar();

    $query = "SELECT * from rol where delete_date is null and create_by <> 0 ";
    $exc_query = mysqli_query($con,$query);

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
      while($row = mysqli_fetch_assoc($exc_query)){
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
