<?php
    include('../model/mantenimiento.php');

    $mantenimientos_instance = new Mantenimiento();

   
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $ubicacion  = $_POST["ubicacion"];
    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"]; 
    $mantenimientos = $mantenimientos_instance->filter_all($codigo, $nombre, $ubicacion, $desde, $hasta);
?>

<table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Equipo</th>
                <th scope="col">Ubicacion</th>
                <th scope="col">Fecha</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while ($row = mysqli_fetch_assoc($mantenimientos)) {
              ?>
              <tr>
                <th scope="row"><?php echo $row["documento"] ?></th>
                <td><?php echo $row["description"] ?></td>
                <td><?php echo $row["ubicacion"] ?></td>
                <td><?php echo $row["fecha"] ?></td>
                <td>
                      <a href="ver_programa.php?id_mantenimiento=<?php echo $row['id'] ?>"><button class="btn btn-warning">Ver</button></a>
                      <button class="btn btn-info">Exportar</button>
                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
        </table>