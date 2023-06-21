<?php
    include("plantilla/menu_top.php");
    $lista_almacenes = $con->conectar();
    $query = "SELECT * from almacenes where delete_date is null";
    $exc_almacenes = mysqli_query($lista_almacenes,$query);
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Almacenes</h3>
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
      while($row = mysqli_fetch_assoc($exc_almacenes)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["codigo"]?></th>
      <td><?php echo $row["description"] ?></td>
      <td>
            <a href="edit_almacenes.php?id=<?php echo $row['id']?>"><button class="btn btn-warning">Editar</button></a>
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
