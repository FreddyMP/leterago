<?php
include("plantilla/menu_top.php");
include("model/ordenes.php");
$Ordenes_instance = new Ordenes();
$ordenes = $Ordenes_instance->list();
?>

<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido">
    <br>
    <h3>Ordenes</h3>
    <div class="formularios">
      <div class="col-md-12 mb-3">
      
            <div class="row mb-4">
              <div class="col-md-2">
                <button class="btn text-primary" id="filtros">Filtros <img class="ml-3" src="imagen/settings.png" width="20" alt=""> </button>
              </div>
              <div class="row filter_div col-md-8">
                <div class="col-md-3 float-left ">
                  <input class="form-control filte_input filter_keyup" type="text" id="orden" placeholder="Num. Orden">
                </div>
                <div class="col-md-3 float-left ">
                  <input class="form-control filte_input filter_keyup" type="text" id="solicitado_por" placeholder="Solicitado por" >
                </div>
                <div class="col-md-3 float-left ">
                  <input class="form-control filte_input2 filter_keyup" type="date" id="desde" >
                </div>
                <div class="col-md-3 float-left ">
                  <input class="form-control filte_input2 filter_keyup" type="date" id="hasta">
                </div>
              </div>
              <div class="col-md-2">
                <button class="btn btn-info ml-3 pl-4 pr-4">Exportar</button>
              </div>
            </div>
          
      </div>
      <div id="resultado">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No. de orden</th>
              <th scope="col">Solicitado por</th>
              <th scope="col">Fecha</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_assoc($ordenes)){
            ?>
            <tr>
              <th scope="row"><?php echo $row["orderNum"] ?></th>
              <td><?php echo $row["solicitadoPor"] ?></td>
          
              <td><?php echo $row["fecha"] ?></td>
              <td>
                    <a href="edit_orden.php?id=<?php echo $row["id"] ?>"><button class="btn btn-warning">Editar</button></a>
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
    orden = $("#orden").val();
    solicitado_por = $("#solicitado_por").val();
    desde = $("#desde").val();
    hasta = $("#hasta").val();

    var datos = {
      orden:orden,
      solicitado_por:solicitado_por,
      desde:desde,
      hasta:hasta
    }
    $.ajax({
            type: "POST",
            url: "reload/filtrar_ordenes.php",
            data: datos,
            success: function(response){
            $("#resultado").html(response);
          }
      });
  });

</script>