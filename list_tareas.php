<?php
include("plantilla/menu_top.php");
include("model/calendario.php");
$calendario_instance = new Calendario();

$programa = $_GET["programa"];
$calendarios = $calendario_instance->list_ejecuciones($programa);

?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Tareas pendientes</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Equipo</th>
      <th scope="col">Fecha</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
    while($row= mysqli_fetch_assoc($calendarios) ){

  ?>
  <tr>
      <th scope="row"><?php echo $row["codigo"] ?></th>
      <td><?php echo $row["descripcion"] ?></td>
      <td><?php echo $row["fecha"] ?></td>
      <td>
        <?php
          $hoy = date("Y-m-d");
          $fecha_asignada_equipo = $row["fecha"];
          $id_equipo = $row["equipo"];
          $id = $row["id"];
          $manana = date("Y-m-d", strtotime($hoy . "+1 day"));
          $despues_tres_dias = date("Y-m-d", strtotime($hoy . "+3 day"));

          if($fecha_asignada_equipo < $hoy){
        ?>
          <a href="crear_mantenimiento.php?id=<?php echo $id_equipo ?>&&ejecucion=<?php echo $id?>&&type=1">
              <button class="btn btn-danger mb-2">
                  Atrasado
              </button>
          </a>

        <?php
          }
          elseif($fecha_asignada_equipo == $hoy){
        ?>
        <a href="crear_mantenimiento.php?id=<?php echo $id_equipo ?>&&ejecucion=<?php echo $id?>&&type=2">
          <button class="btn btn-info mb-2">
            Para hoy
          </button>
        </a>

        <?php
          }
          elseif($fecha_asignada_equipo == $manana || $fecha_asignada_equipo <= $despues_tres_dias && $fecha_asignada_equipo > $hoy){
        ?>
        <a href=""><button class="btn btn-warning mb-2">Proximo</button></a>
        <?php
          }else{
            ?>
              <button class="btn btn-secondary mb-2">Inactivo</button>
            <?php
          }
        ?>
      </td>
  </tr>
  <?php
    }
  ?>
   
  </tbody>
</table>
    </div>
</div>
