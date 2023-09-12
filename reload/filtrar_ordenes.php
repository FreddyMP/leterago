<?php
   include("../model/ordenes.php");
   $Ordenes_instance = new Ordenes();

    $orden = $_POST["orden"];
    $solicitado_por = $_POST["solicitado_por"];
    $desde  = $_POST["desde"];
    $hasta = $_POST["hasta"];

    $ordenes = $Ordenes_instance->filter($orden, $solicitado_por, $desde, $hasta);
?>

<table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No. de orden</th>
              <th scope="col">Solicitado por</th>
              <th scope="col">Departamento</th>
              <th scope="col">Fecha</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_assoc($ordenes)){
            ?>
            <tr>
              <th scope="row"><?php echo $row["orderNum"] ?></th>
              <td><?php echo $row["solicitadoPor"] ?></td>
              <td><?php echo $row["departamento"] ?></td>
              <td><?php echo $row["fecha"] ?></td>
              <td>
                    <a href="edit_orden.php?id=<?php echo $row["id"] ?>"><button class="btn btn-warning">Editar</button></a>
                    <button class="btn btn-info">Exportar</button>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>