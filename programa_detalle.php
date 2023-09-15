<?php
  
  include("plantilla/menu_top.php");
  include("model/programas.php");
  $programa_instance = new Programas();

  $id = $_GET["id"];


  $programa_exc = $programa_instance->list_header();
  $programa = $programa_instance->find($id);
  $list_programa = $programa_instance->list_details($id);
  $not_list_programa = $programa_instance->not_list_details($id);
  

$header = $_GET["id_header"];

?>

<link rel="stylesheet" href="css/form.css">
  <div class="Container">
    <br>
    <h3>Detalles de la programacion: </h3>
    <div class="formularios">
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="" placeholder="Buscar equipo">
            </div>
            <div class="col-md-6">
                <button class = "btn btn-success float-right mb-3">Agregar todos</button>
            </div>
        </div>
        <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Marca</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($row = mysqli_fetch_assoc($list_programa)){
          ?>
          <tr>
            <th scope="row"><?php echo $row["codigo"] ?></th>
            <td><?php echo $row["descripcion"] ?></td>
            <td><?php echo $row["marca"] ?></td>
            <td>
                <a href="controllers/del_equipo_programa.php?id_equipo=<?php echo $row["id_equipo"] ?>&&id_header=<?php echo $id ?>&&from_programa=1" class="btn btn-danger mb-2">Quitar</a>
            </td>
          </tr>
          <?php
            }
          ?>
          <?php
            while($row2 = mysqli_fetch_assoc($not_list_programa)){
          ?>
          <tr>
            <th scope="row"><?php echo $row2["codigo"] ?></th>
            <td><?php echo $row2["description"] ?></td>
            <td><?php echo $row2["marca"] ?></td>
            <td>
              <a href="controllers/add_equipo_programa.php?id_equipo=<?php echo $row2["id"] ?>&&id_header=<?php echo $id ?>&&from_programa=1" class="btn btn-info mb-2">Agregar</a>
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
