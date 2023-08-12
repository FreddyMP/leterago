<?php
include("plantilla/menu_top.php");
include("model/programas.php");
$programa_instance = new Programas();

$programa_exc = $programa_instance->list_header();
?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Programaciones</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Version</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($row = mysqli_fetch_assoc($programa_exc)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["doc_no"] ?></th>
      <td><?php echo $row["descripcion"] ?></td>
      <td><?php echo $row["version"] ?></td>
      <td>
        
        <?php 
          $estado = $row["estado"];
          $id = $row["id"];
          if($estado != 0){
        ?>
          <a href="list_tareas.php?programa=<?php echo $id ?>"><button class="btn btn-success mb-2">Tareas</button></a>
          <a href="ver_programa.php?id=<?php echo $row["id"] ?>"><button class="btn btn-warning mb-2">Editar</button></a>
          <?php
          }
          ?>
          <button class="btn btn-info mb-2">Exportar</button>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
    </div>
</div>
