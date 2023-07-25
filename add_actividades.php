<?php
    include("plantilla/menu_top.php"); 
    include("model/actividades.php");
    include("model/equipo_actividad.php");
    $actividades_intance= new Actividades();
    $id = $_GET["id"];

    $equipo_actividad_instance = new Equipo_actividad();
    $equipo_actividad = $equipo_actividad_instance->list($id);

    $actividades = $equipo_actividad_instance->list_actividades_search($id);
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Agregar actividades</h3>
    <div class="formularios">
    <form action="controllers/add_actividad.php" method="post">
        <div class="row">
            
            <div class="col-md-6">
                <input type="hidden" name="id_equipo" value="<?php echo $id ?>" id="">
                <select class="form-control" name="id_actividad" id="">
                    <?php
                        while ($row = mysqli_fetch_assoc($actividades)) {
                    ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["description"] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <button class = "btn btn-info col-md-4 float-right mb-3">Agregar</button>
            </div>
            
        </div>
        </form>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Actividades</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        while ($row = mysqli_fetch_assoc($equipo_actividad)) {
            $actividades_list = $actividades_intance->find($row["id_actividad"]);
    ?>
    <tr>
      <th scope="row"><?php echo $row["id"] ?></th>
      <td><?php echo $actividades_list["description"] ?></td>
      <td>
        <a href="controllers/delete_equipo_actividad.php?id=<?php echo $row["id"] ?>&&id_equipo=<?php echo $id?>" class="btn btn-warning ">Quitar</a>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
    </div>
</div>