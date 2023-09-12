<?php
    include_once("../model/calendario.php");

    $calendario_instance = New Calendario();
    

    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $frecuencia = $_POST["frecuencia"];

    $exc_equipos = $calendario_instance->filter_find_equipos_programacion($codigo, $nombre, $marca, $frecuencia);
    $numero_de_mantenimientos = 0;

?>

<table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Codigo</th>
          <th scope="col">Nombre</th>
          <th scope="col">Marca</th>
          <th scope="col">Frecuencia</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          while($equipos = mysqli_fetch_assoc($exc_equipos)){

        ?>
        <tr>
          <th scope="row"><?php echo $equipos["codigo"] ?></th>
          <td><?php echo $equipos["description"]?></td>
          <td><?php echo $equipos["marca"]?></td>
          <td><?php 
                    if($equipos["frecuencia"] == '1'){
                        echo 'Mensual';
                        $numero_de_mantenimientos = 12;
                    }
                    if($equipos["frecuencia"] == '2'){
                        echo 'Bimensual';
                        $numero_de_mantenimientos = 6;
                    }
                    if($equipos["frecuencia"] == '3'){
                        echo 'Trimestral';
                        $numero_de_mantenimientos = 4;
                    }
                    if($equipos["frecuencia"] == '4'){
                        echo 'Cuatrimestral';
                        $numero_de_mantenimientos = 3;
                    }
                    if($equipos["frecuencia"] == '5'){
                        echo 'Semestral';
                        $numero_de_mantenimientos = 2;
                    }
                    if($equipos["frecuencia"] == '6'){
                        echo 'Anual';
                        $numero_de_mantenimientos = 1;
                    }

                    ?>                
            <td>
                  <a class="btn btn-info" href="asignar_fechas.php?id=<?php echo $equipos["id"] ?>&&cantidad=<?php echo $numero_de_mantenimientos ?>"><small>Asignar fechas</small></a>
            </td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>