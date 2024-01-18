<?php
include("plantilla/menu_top.php");
include("model/programas.php");
$programa_instance = new Programas();

$programa_exc = $programa_instance->list_header();
?>

<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido" >
    <br>
    <h3>Programaciones</h3>
    <div class="formularios">
      <div class = "filtros mb-4">
        <div class="row">
        <div class="col-md-12">
          <!--
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
-->
          </div>
        </div>
      </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Version</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($row = mysqli_fetch_assoc($programa_exc)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["doc_no"] ?></th>
      <td><?php echo $row["descripcion"] ?></td>
      <td><?php echo $row["version"] ?></td>
      <td>
        
        <?php 
          $hoy = date("Y-m-d");
          $estado = $row["estado"];
          $id = $row["id"];
          if($estado != 0){
            if($row["fecha_fin"] >= $hoy ) { ?>
              <a href="list_tareas.php?programa=<?php echo $id ?>">
                <button class="btn btn-success mb-2">
                  Tareas <?php
                        if($row["fecha_fin"] <= $hoy ){
                          echo "es menor";
                        }
                        ?>
                </button>
              </a>
            <?php
              }
            ?>
            <a href="edit_programa.php?id=<?php echo $id ?>"><button class="btn btn-warning mb-2">Editar</button></a>
          <?php
          }
          ?>
          <button class="btn btn-info mb-2">Exportar</button>
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