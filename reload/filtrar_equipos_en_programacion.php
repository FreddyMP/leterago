<?php
include("../model/programas.php");
$programa_instance = new Programas();

$id = $_POST["id"];
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$marca = $_POST["marca"];

$list_programa = $programa_instance->filter_list_details($id, $codigo, $nombre, $marca);
$not_list_programa = $programa_instance->filter_not_list_details($id, $codigo, $nombre, $marca);

?>

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
