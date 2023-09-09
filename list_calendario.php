<?php
    include("plantilla/menu_top.php");
    include_once("model/calendario.php");
    include("model/programas.php");

    $programas_instance = new Programas();
    $programas = $programas_instance->find_active();

    $calendario_instance = New Calendario();
    
    $exc_equipos = $calendario_instance->find_equipos_programacion();
    $numero_de_mantenimientos = 0;
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Asignacion de fechas</h3>
    <div class="formularios">
      <div class = "filtros mb-4">
        <div class="row">
          <div class="col-md-12">
            <div class="row mb-4">
              <div class="col-md-2">
                <button class="btn text-primary" id="filtros">Filtros <img class="ml-3" src="imagen/settings.png" width="20" alt=""> </button>
              </div>
              <div class="row filter_div col-md-10">
                <div class="col-md-2 float-left ">
                  <input class="form-control filte_input filter_keyup" type="text" id="codigo" placeholder="Codigo">
                </div>
                <div class="col-md-4 float-left ">
                  <input class="form-control filte_input2 filter_keyup" type="text" id="nombre" placeholder="Nombre del equipo">
                </div>
                <div class="col-md-2 float-left ">
                  <input class="form-control filte_input2 filter_keyup" type="text" id="ubicacion" placeholder="Marca">
                </div>
                <div class="col-md-3 float-left ">
                  <input class="form-control filte_input2 filter_keyup" type="text" id="frecuencia" placeholder="Frecuencia">
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
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
    </div>
</div>

<script>
  $("#filtros").click(function(){
    $(".filter_div").toggle(1500);
  });


  $(".filter_keyup").keyup(function(){
    codigo = $("#codigo").val();
    nombre = $("#nombre").val();
    ubicacion  = $("#ubicacion").val();
    desde = $("#desde").val();
    hasta = $("#hasta").val();

    var datos = {
      nombre:nombre,
      codigo:codigo,
      ubicacion:ubicacion,
      desde:desde,
      hasta:hasta
    }
    $.ajax({
            type: "POST",
            url: "reload/filtrar_all_mantenimientos.php",
            data: datos,
            success: function(response){
            $("#resultado").html(response);
          }
      });
  });

</script>