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
      <div class = "filtros mb-4">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Codigo" id="">
              </div>
              <div class="col-md-8">
                <input class="form-control" type="text" placeholder="Descripcion" id="">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="float-right">
                <button class="btn btn-success pl-5 pr-5">Buscar programacion</button>
            </div>
          </div>
        </div>
      </div>
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
          <a href="edit_programa.php?id=<?php echo $id ?>"><button class="btn btn-warning mb-2">Editar</button></a>
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
