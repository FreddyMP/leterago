<?php
    include("plantilla/menu_top.php");
    include("model/equipos.php");

    $equipos_instance = New Equipos();
    $exc_equipos = $equipos_instance->list();
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Equipos</h3>
    <div class="formularios">
      <div class="col-md-12 mb-4">
        <div class="row">
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
              <input class="form-control filte_input2 filter_keyup" type="text" id="marca" placeholder="Marca">
            </div>
            <div class="col-md-4 float-left ">
              <input class="form-control filte_input2 filter_keyup" type="text" id="modelo" placeholder="Modelo">
            </div>
          </div>
        </div>
      </div>
      <div id="resultado">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Codigo</th>
              <th scope="col">Nombre</th>
              <th scope="col">Marca</th>
              <th scope="col">Modelo</th>
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
              <td>
                    <a href="edit_equipo.php?id=<?php echo $equipos["id"] ?>"><button class="btn btn-warning"> <small>Editar</small></button></a>
                    <button class="btn btn-danger"><small>Eliminar</small></button>
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
    marca  = $("#marca").val();
    modelo = $("#modelo").val();

    var datos = {
      nombre:nombre,
      codigo:codigo,
      marca:marca,
      modelo:modelo
    }
    $.ajax({
            type: "POST",
            url: "reload/buscar_equipo_all.php",
            data: datos,
            success: function(response){
            $("#resultado").html(response);
          }
      });
  });

</script>