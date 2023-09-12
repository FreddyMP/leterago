<?php
    include('../model/mantenimiento.php');

    $mantenimientos_instance = new Mantenimiento();

    $nombre = $_POST["nombre"];
    $id = $_POST["id"];
    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"]; 

    $mantenimientos = $mantenimientos_instance->filter_find_by_equipo($id, $nombre, $desde, $hasta);
?>

<table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Realizado por</th>
              <th scope="col">Fecha planificacion</th>
              <th scope="col">Fecha</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              while($row = mysqli_fetch_assoc($mantenimientos)){
            ?>
            <tr>
              <th scope="row"><?php echo $row["nombre"]." ".$row["apellido"] ?></th>
              <td><?php echo $row["fecha_planificacion"]?></td>
              <td><?php echo $row["fecha"]?></td>
              <td>
                    <a href="ver_programa.php"><button class="btn btn-warning">Ver mas</button></a>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>