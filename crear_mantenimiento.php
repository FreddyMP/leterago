<?php
    include("plantilla/menu_top.php"); 
    include ('model/equipos.php');
    include('model/ubicaciones.php');

    $equipos_instance = new Equipos();
    $ubicaciones_instance = new Ubicaciones();

    $equipo_list = $equipos_instance->list();
    $ubicaciones_list = $ubicaciones_instance->list();

?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
<?php

?>
    <h3>Crear mantenimiento</h3>
    <div class="formularios">
        <form action="controllers/create_mantenimiento.php" method="post">
            <div class="row">
                <div class="col-md-6 mt-3">
                  Doc. No
                    <input class="form-control" name="documento_no" type="text" placeholder="Documento No." required>
                </div>
                <div class="col-md-6 mt-3">
                  Version
                    <input class="form-control" name="version" type="text" placeholder="Version" required>
                </div>
                <div class="col-md-6 mt-3">
                  Documento relacionado
                    <input class="form-control" name="doc_relacionado" type="text" placeholder="Doc. relacionado" required>
                </div>
                <div class="col-md-6 mt-3">
                  Codigo
                    <input class="form-control" name="codigo" type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-6 mt-3">
                  Fecha de planificacion
                    <input class="form-control" name="fecha" type="date">
                </div>
                <div class="col-md-6 mt-3">
                  Fecha realizado
                    <input class="form-control" name="fecha" type="date">
                </div>
                <div class="col-md-12 mt-3">
                  Ubicacion
                    <select class="form-control" name="ubicacion" id="">
                        <?php
                          while($ubicacion= mysqli_fetch_assoc($ubicaciones_list)){
                        ?>
                        <option value="<?php echo $ubicacion['id'] ?>"><?php echo $ubicacion['description'] ?></option>
                        <?php
                          }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                  <select class="form-control" name="equipo" id="equipos">
                        <?php
                          while($equipo= mysqli_fetch_assoc($equipo_list)){
                        ?>
                        <option value="<?php echo $equipo['id'] ?>"><?php echo $equipo['codigo']." ".$equipo['description'] ?></option>
                        <?php
                          }
                        ?>
                    </select>
                </div>
            </div>

                <h3 class="mt-3 mb-3">Acciones</h3>
                <div id = "tabla">

                </div>
                  <textarea name="observaciones" class="form-control" placeholder="Observaciones generales"></textarea>
                  <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
              
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