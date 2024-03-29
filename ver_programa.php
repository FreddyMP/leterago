<?php
    include("plantilla/menu_top.php"); 
    include ('model/mantenimiento.php');
    include ('model/equipos.php');
    include ('model/ubicaciones.php');
    include ('model/actividades.php');

    $mantenimiento_instance = new Mantenimiento();
    $actividades_instance = new Actividades();
    $equipos_instance = new Equipos();
    $ubicaciones_instance = new Ubicaciones();


    $id_mantenimiento = $_GET["id_mantenimiento"];

    $mantenimiento = mysqli_fetch_assoc($mantenimiento_instance->edit($id_mantenimiento));

    $mantenimiento_details = $mantenimiento_instance->find_details($id_mantenimiento);

    $id_equipo = $mantenimiento["equipo"];

    $equipo = $equipos_instance->find($id_equipo);

    $id_ubicacion = $equipo["ubicacion"];

    $ubicacion = $ubicaciones_instance->find($id_ubicacion);

    
    
?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
<?php

?>
    <h3>Crear mantenimiento</h3>
    <div class="formularios">
        <form action="controllers/create_mantenimiento.php" method="post">
            <div class="row">
                <div class="col-md-6 mt-3">
                  Doc. No
                    <input class="form-control" readonly value = "<?php echo $mantenimiento["documento_no"] ?>" name="documento_no" type="text" placeholder="Documento No." required>
                </div>
                <div class="col-md-6 mt-3">
                  Version
                    <input class="form-control" readonly  value = "<?php echo $mantenimiento["version"] ?>"  name="version" type="text" placeholder="Version" required>
                </div>
                <div class="col-md-6 mt-3">
                  Documento relacionado
                    <input class="form-control" readonly  value = "<?php echo $mantenimiento["documento_relacionado"] ?>" name="doc_relacionado" type="text" placeholder="Doc. relacionado" required>
                </div>
                <div class="col-md-6 mt-3">
                  Codigo
                    <input class="form-control" value = "<?php echo $mantenimiento["codigo"]  ?>" readonly name="codigo" type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-6 mt-3">
                  Fecha de planificacion
                    <input class="form-control" name="fecha_planificacion" value="<?php echo  $mantenimiento["date_planification"]?>" readonly type="date">
                </div>
                <div class="col-md-6 mt-3">
                  Fecha realizado
                    <input class="form-control" name="fecha" value="<?php echo $mantenimiento['fecha']?>" readonly type="date">
                </div>
                <div class="col-md-12 mt-3">
                  Ubicacion
                  <input class="form-control" name="ubicacion" value="<?php echo $ubicacion["description"]?>" readonly type="text">
                </div>
                <div class="col-md-12 mt-3">
                Nombre del equipo
                    <input class="form-control" readonly value = "<?php echo $equipo["description"] ?>"type="text">
                    <input class="form-control" readonly value = "<?php echo $equipo["id"] ?>" name="equipo" type="hidden" required>
                    <input class="form-control" readonly value = "<?php echo $ejecucion ?>" name="ejecucion" type="hidden" required>
                </div>
                <?php
                  if($mantenimiento["razon_tardanza"] != '' or $mantenimiento["razon_tardanza"] != null ){
                ?>
                <div class="col-md-12 mt-3">
                Razon de tardanza
                          <textarea class="form-control" readonly name="razon_tardanza" id="" cols="30" rows="3" required placeholder="Razones de la tardanza"><?php echo $mantenimiento['razon_tardanza']?></textarea>
                </div>
                <?php
                     }
                ?>
            </div>

                <h3 class="mt-3 mb-3">Acciones</h3>
                <div id = "tabla">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Actividad</th>
                        <th scope="col">  OK</th>
                        <th scope="col">  N/A</th>
                        <th scope="col">  R</th>
                        <th scope="col">Observaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $contador_checks = 0;
                        while ($details = mysqli_fetch_assoc($mantenimiento_details)) {
                          $id_actividad = $details["id_actividad"];
                          $actividad = $actividades_instance->find($id_actividad);
                      ?>
                      <tr>
                        <th scope="row"><?php echo $actividad["description"] ?></th>
                        <td><input  type="checkbox" <?php if($details["ok"] == 1 ) {?>  checked <?php }?>></td>
                        <td><input  type="checkbox" <?php if($details["no_aplica"] == 1 ) {?>  checked <?php }?>></td>
                        <td><input  type="checkbox"  <?php if($details["r"] == 1 ) {?>  checked <?php }?>></td>
                        <td>
                          <input readonly  class="form-control" type="text" value="<?php echo $details["observacion"] ?>">
                        </td>
                      </tr>
                      <?php
                        $contador_checks++;
                        }
                      ?>
                    
                    </tbody>
                  </table>

                </div>
                  <textarea readonly class="form-control" placeholder="Observaciones generales"><?php echo $mantenimiento["observaciones"] ?></textarea>
                
              
            </form>
    </div>
</div>

<script>
  
  $("#equipos").change(function(){
  equipo = $("#equipos").val();
  $.ajax({url: "reload/list_actions.php",
          method:"post",
          data: "id_equipo="+equipo,
          success: function(result){
    $("#tabla").empty();     
    $("#tabla").append(result);
  }});
});
</script>