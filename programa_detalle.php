<?php
include("plantilla/menu_top.php");
include("model/programas.php");
include("model/equipos.php");
include("model/almacenes.php");
include("model/equipo_actividad.php");
include("model/actividades.php");

$programa_instance = new Programas();
$equipos_instance = new Equipos();
$almacenes_instance = new Almacenes();
$equipos_actividades = new Equipo_actividad();
$actividades = new Actividades();


$exc_equipo = $equipos_instance->list();

$header = $_GET["id_header"];

?>

<link rel="stylesheet" href="css/form.css">
  <div class="Container">
    <br>
    <h3>Detalles de la programacion: </h3>
    <div class="formularios">
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="" placeholder="Buscar equipo">
            </div>
            <div class="col-md-6">
                <button class = "btn btn-success float-right mb-3">Agregar todos</button>
            </div>
        </div>
       
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Equipo</th>
            <th scope="col">Actividades</th>
            <th scope="col">Frecuencia</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
      <tbody>
        <?php
          while ($row = mysqli_fetch_assoc($exc_equipo)) {

        ?>
          <tr>
            <th scope="row"><?php  echo $row["codigo"]?></th>
            <td>
                <?php 
                    $almacenes = $almacenes_instance->find($row["id_almacen"]);
                    $almacenes_description = $almacenes["description"];
                      echo $row["description"]."(".$almacenes_description.")"?>
            </td>
            <td><?php
                $exc_actividades = $equipos_actividades->list_actividades_search($row["id"]);
                while($actividades = mysqli_fetch_assoc($exc_actividades)){
                  echo $actividades["description"].", ";
                }
              ?>
            </td>
            <td>  
              <?php  
                if($row["frecuencia"] == '1'){
                  echo 'Mensual';
                }
                if($row["frecuencia"] == '2'){
                  echo 'Bimensual';
                }
                if($row["frecuencia"] == '3'){
                  echo 'Trimestral';
                }
                if($row["frecuencia"] == '4'){
                  echo 'Cuatrimestral';
                }
                if($row["frecuencia"] == '5'){
                  echo 'Semestral';
                }
                if($row["frecuencia"] == '6'){
                  echo 'Anual';
                }
              
              ?>
          
            </td>
            <td>
              <?php
                $equipo_existe = $programa_instance->find_details($header, $row["id"]);
                $existe = $equipo_existe["existe"];
                if($existe < 1){
              ?>
              <a class="btn btn-info" href="controllers/add_equipo_programa.php?id_header=<?php echo $header?>&&id_equipo=<?php echo $row["id"] ?>" >Agregar</a>
              <?php
                }else{
                  ?>
                  <a class="btn btn-danger" href="controllers/del_equipo_programa.php?id_header=<?php echo $header?>&&id_equipo=<?php echo $row["id"] ?>" >Quitar</a>
                  <?php
                }
              ?>
            </td>
          </tr>
          
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
