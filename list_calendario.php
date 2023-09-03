<?php
    include("plantilla/menu_top.php");
    include("model/equipos.php");
    include("model/programas.php");

    $programas_instance = new Programas();
    $programas = $programas_instance->find_active();

    $equipos_instance = New Equipos();
    
    $exc_equipos = $equipos_instance->list();
    $numero_de_mantenimientos = 0;
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Asignacion de fechas</h3>
    <div class="formularios">
    <div class = "filtros mb-4">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-3">
                <input class="form-control" type="text" placeholder="Codigo" id="">
              </div>
              <div class="col-md-5">
                <input class="form-control" type="text" placeholder="Descripcion" id="">
              </div>
              <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Marca" id="">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="float-right">
                <button class="btn btn-success pl-5 pr-5">Buscar equipo</button>
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

