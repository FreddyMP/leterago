<?php
include("plantilla/menu_top.php");
include('model/mantenimiento.php');

$mantenimientos_instance = new Mantenimiento();

$id= $_GET["id"];
$mantenimientos = $mantenimientos_instance->find_by_equipo($id);

?>

<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido">
    <br>
    <h3>AA0012: Aire acondicionado inverte</h3>
    <div class="formularios">
      <div class="col-md-12 mb-3">
      <div class="row">
          <div class="col-md-12">
            <div class="row mb-4">
              <div class="col-md-2">
                <button class="btn text-primary" id="filtros">Filtros <img class="ml-3" src="imagen/settings.png" width="20" alt=""> </button>
              </div>
              <div class="row filter_div col-md-7">
                <div class="col-md-4 float-left ">
                  Usuario
                  <input class="form-control filte_input filter_keyup" type="text" id="nombre" placeholder="Realizados por" >
                  <input  type="hidden" id="id" value="<?php echo $id ?>" >
                </div>
                <div class="col-md-4 float-left ">
                  desde
                  <input class="form-control filte_input filter_keyup" type="date" id="desde" >
                </div>
                <div class="col-md-4 float-left ">
                  hasta
                  <input class="form-control filte_input2 filter_keyup" type="date" id="hasta" placeholder="Nombre del equipo">
                </div>
              </div>
              <div class="col-md-3">
                <a class="btn btn-danger text-light ml-3 Generar_PDF">PDF</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="resultado">
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
                    <a href="ver_programa.php?id_mantenimiento=<?php echo $row["id"] ?>"><button class="btn btn-warning">Ver mas</button></a>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
      
    </div>
</div>

<script>
  $("#filtros").click(function(){
    $(".filter_div").toggle(1500);
  });


  $(".filter_keyup").keyup(function(){
    id = $("#id").val();
    nombre = $("#nombre").val();
    desde = $("#desde").val();
    hasta = $("#hasta").val();

    var datos = {
      nombre:nombre,
      id:id,
      desde:desde,
      hasta:hasta
    }
    $.ajax({
            type: "POST",
            url: "reload/filtrar_equipo_mantenimientos.php",
            data: datos,
            success: function(response){
            $("#resultado").html(response);
          }
      });
  });

  $(".Generar_PDF").click(function(){
    id = $("#id").val();
    nombre = $("#nombre").val();
    desde = $("#desde").val();
    hasta = $("#hasta").val();

    window.open("pdf/mantenimientos_equipo_especifico.php?nombre="+nombre+"&&desde="+desde+"&&hasta="+hasta+"&&id="+id);
  });
</script>