<?php
    include("plantilla/menu_top.php");
    include("model/programas.php");
    include("model/equipos.php");
    include("model/almacenes.php");
    include("model/equipo_actividad.php");
    include("model/actividades.php");

    $equipos_instance = new Equipos();
    $almacenes_instance = new Almacenes();
    $equipos_actividades = new Equipo_actividad();
    $actividades = new Actividades();


    $exc_equipo = $equipos_instance->list();

    $header = $_GET["id"];


    $programas_instance = new Programas();

    $id_programa = $_GET["id"];
    $programa = $programas_instance->find($id_programa);

?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
    <h3>Editar programa: RPG-005</h3>
    <div class="formularios">
        <form action="controllers/editar_programa.php" method="post">
        <div class="row">
                <div class="col-md-4 mb-3">
                    Doc. RPG
                    <input class="form-control"  value="<?php echo $programa["doc_no"] ?>" name="doc_no" type="text" placeholder="Doc. relacionado">
                </div>
                <input class="form-control"  value="<?php echo $programa["id"] ?>" name="id" type="hidden">

                <div class="col-md-4 mb-3">
                    Inicio
                    <input class="form-control"  value="<?php echo $programa["fecha_ini"] ?>" name="fecha_ini" type="text" >
                </div>
                <div class="col-md-4 mb-3">
                    Finalizacion
                    <input class="form-control"  value="<?php echo $programa["fecha_fin"] ?>" name="fecha_fin" type="text" >
                </div>
                <div class="col-md-2 mb-4">
                    Doc FOR
                    <input class="form-control" value="<?php echo $programa["doc_relacionado"] ?>" name="doc_relacionado" type="text" placeholder="Doc. No.">
                </div>
                <div class="col-md-2 mb-4">
                    Version
                    <input class="form-control"  value="<?php echo $programa["version"] ?>" name="version" type="text" placeholder="Version">
                </div>
                <div class="col-md-8 mb-4">
                    Descripcion de la planificacion
                    <input class="form-control" value="<?php echo $programa["descripcion"] ?>" name="descripcion" type="text" placeholder="Descripcion">
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>

<div class="Container">
    <br>
    <h3>Detalles de la programacion</h3>
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
                if($row["frecuencia"] == '0'){
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
                $equipo_existe = $programas_instance->find_details($header, $row["id"]);
                $existe = $equipo_existe["existe"];
                if($existe < 1){
              ?>
              <a class="btn btn-info" href="controllers/add_equipo_programa.php?id_header=<?php echo $header?>&&id_equipo=<?php echo $row["id"] ?>&&from_programa=1" >Agregar</a>
              <?php
                }else{
                  ?>
                  <a class="btn btn-danger" href="controllers/del_equipo_programa.php?id_header=<?php echo $header?>&&id_equipo=<?php echo $row["id"]?>&&from_programa=1" >Quitar</a>
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


