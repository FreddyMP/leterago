<?php
include("plantilla/menu_top.php");
include("model/programas.php");
$programa_instance = new Programas();

$id = $_GET["id"];


$programa_exc = $programa_instance->list_header();
$programa = $programa_instance->find($id);
$list_programa = $programa_instance->list_details($id);
$not_list_programa = $programa_instance->not_list_details($id);
?>

<link rel="stylesheet" href="css/form.css">
<div class="cargando" >
      <img class = "cargando_img" src="imagen/loading.gif"  alt="">
</div>

<div class="Container Container1">
    <br>
    <h3>Planificacion: <?php echo $programa["descripcion"] ?></h3>
    <div class="formularios">
      <div class = "filtros mb-4">
      <form action="controllers/editar_programa.php" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    Doc. RPG
                    <input class="form-control" name="doc_no" value="<?php echo $programa["doc_no"] ?>" type="text" placeholder="Doc. relacionado">
                </div>
                <div class="col-md-4 mb-3">
                    Inicio
                    <input class="form-control" value="<?php echo $programa["fecha_ini"] ?>" name="fecha_ini" type="date" >
                </div>
                <div class="col-md-4 mb-3">
                    Finalizacion
                    <input class="form-control" value="<?php echo $programa["fecha_fin"] ?>" name="fecha_fin" type="date" >
                </div>
                <div class="col-md-2 mb-4">
                    Doc FOR
                    <input class="form-control" value="<?php echo $programa["doc_relacionado"] ?>" name="doc_relacionado" type="text" placeholder="Doc. No.">
                </div>
                <div class="col-md-2 mb-4">
                    Version
                    <input type="hidden" name="id" value = "<?php echo $id ?>">
                    <input class="form-control" value="<?php echo $programa["version"] ?>" name="version" type="text" placeholder="Version">
                </div>
                <div class="col-md-8 mb-4">
                    Descripcion de la planificacion
                    <input class="form-control" value="<?php echo $programa["descripcion"] ?>" name="descripcion" type="text" placeholder="Descripcion">
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Codigo" id="">
              </div>
              <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Descripcion" id="">
              </div>
              <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Marca" id="">
              </div>
              <div class="col-md-4">
                <button class="btn btn-secondary">IN</button>
                <button class="btn btn-secondary">OUT</button>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row">
                <div class="col-md-6">
                  <a href="reload/add_all.php?id=<?php echo $id ?>" class="btn btn-success pl-4 pr-4">Todos</a>
                </div>
                <div class="col-md-6">
                  <a id="ninguno" class="btn btn-warning pl-3 pr-3">Ninguno</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Marca</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($row = mysqli_fetch_assoc($list_programa)){
    ?>
    <tr>
      <th scope="row"><?php echo $row["codigo"] ?></th>
      <td><?php echo $row["descripcion"] ?></td>
      <td><?php echo $row["marca"] ?></td>
      <td>
          <a href="controllers/del_equipo_programa.php?id_equipo=<?php echo $row["id_equipo"] ?>&&id_header=<?php echo $id ?>&&from_programa=1" class="btn btn-danger mb-2">Quitar</a>
      </td>
    </tr>
    <?php
      }
    ?>
     <?php
      while($row2 = mysqli_fetch_assoc($not_list_programa)){
    ?>
    <tr>
      <th scope="row"><?php echo $row2["codigo"] ?></th>
      <td><?php echo $row2["description"] ?></td>
      <td><?php echo $row2["marca"] ?></td>
      <td>
        <a href="controllers/add_equipo_programa.php?id_equipo=<?php echo $row2["id"] ?>&&id_header=<?php echo $id ?>&&from_programa=1" class="btn btn-info mb-2">Agregar</a>
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

$(document).ready(function(){
$(".Container").show();
$(".cargando").hide();

});
</script>