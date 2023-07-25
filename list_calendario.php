<?php
    include("plantilla/menu_top.php");
    include("model/equipos.php");
    include("model/programas.php");

    $programas_instance = new Programas();
    $programas = $programas_instance->find_active();

    $equipos_instance = New Equipos();
    
    $exc_equipos = $equipos_instance->list();
    $numero_de_mantenimientos = 0;
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Asignacion de fechas</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Marca</th>
      <th scope="col">Modelo</th>
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
      <td><?php echo $equipos["modelo"]?></td>
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
            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong<?php echo $equipos["id"]?>"><small>Asignar fechas</small></button>
      </td>
    </tr>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong<?php echo $equipos["id"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Calendario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="controllers/add_calendar.php" method="post">
      <div class="modal-body">
        <p>Asignar fechas </p>
        
        <?php
        $fechas_list = 1;
            while($fechas_list <= $numero_de_mantenimientos){
                ?>
                    <input type="hidden" value="<?php echo  $programas["id"] ?> " name="id_programa">
                    <input type="hidden" value="<?php echo $equipos["id"]?>" name="id_equipo">
                    <input type="hidden" value="<?php echo $numero_de_mantenimientos ?>" name="total">
                    <input type="date" class="form-control mb-3 fecha" min = "<?php echo $programas["fecha_ini"] ?>" max="<?php echo $programas["fecha_fin"] ?>" name="f<?php echo $fechas_list ?>" id="fecha">
                <?php
                $fechas_list++;
            }
        ?>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Guardar">
      </div>
      </form>
    </div>
  </div>
</div>
    <?php
      }
    ?>
 
            </tbody>
        </table>
    </div>
</div>
<script>

</script>
