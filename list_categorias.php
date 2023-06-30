<?php
    include("plantilla/menu_top.php");
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Categorias</h3>
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

    <tr>
      <th scope="row">BB</th>
      <td>Bombas</td>
      <td>
            <a href="edit_almacenes.php?id=<?php echo $row['id']?>"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-danger">Eliminar</button>
      </td>
    </tr>
    <tr>
      <th scope="row">AA</th>
      <td>Aire acondicionado</td>
      <td>
            <a href="edit_almacenes.php?id=<?php echo $row['id']?>"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-danger">Eliminar</button>
      </td>
    </tr>

  </tbody>
</table>
    </div>
</div>
