<?php
include("plantilla/menu_top.php");
include('model/mantenimiento.php');

$mantenimientos_instance = new Mantenimiento();

$mantenimientos = $mantenimientos_instance->list();

?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Reportes de mantenimiento</h3>
    <div class="formularios">
      <div class="col-md-12 mb-3">
        <div class="row mb-4">
          <div class="col-md-2">
            <button class="btn text-primary" id="filtros">Filtros <img class="ml-3" src="imagen/settings.png" width="20" alt=""> </button>
          </div>
          <div class="row filter_div col-md-9">
            <div class="col-md-2 float-left ">
              <input class="form-control filte_input filter_keyup" type="text" id="codigo" placeholder="Codigo">
            </div>
            <div class="col-md-4 float-left ">
              <input class="form-control filte_input2 filter_keyup" type="text" id="nombre" placeholder="Nombre del equipo">
            </div>
            <div class="col-md-2 float-left ">
              <input class="form-control filte_input2 filter_keyup" type="text" id="ubicacion" placeholder="Ubicacion">
            </div>
            <div class="col-md-2 float-left ">
              <input class="form-control filte_input2 filter_fechas" type="date" id="desde">
            </div>
            <div class="col-md-2 float-left ">
              <input class="form-control filte_input2 filter_fechas" type="date" id="hasta">
            </div>
          </div>
          <div class="col-md-1 float-right p">
              <button class="btn btn-danger float-right">PDF</button>
          </div>
        </div>
          <div id="resultado">
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
      </div>
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