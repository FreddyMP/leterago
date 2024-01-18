<?php
    include("plantilla/menu_top.php"); 
    include("model/ordenes.php");
    $Ordenes_instance = new Ordenes();
    $id = $_GET["id"];
    $orden = $Ordenes_instance->find($id);
?>
<link rel="stylesheet" href="css/form.css">
<div class="bloque_contenido"><br>
<?php
 
    if(isset($_GET["error_create"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error de creacion!</h4>
      <p>Recuerda los nombres de usuarios no pueden repetirse<hr>
      <p class="mb-0">Si el usuario no existe y el error persiste escriba a su suplidor</p>
    </div>
<?php
    }
?>
    <h3>Editar orden</h3>
    <div class="formularios">
      <!--  <form action="participacion_orden.php" method="post"> -->
        <form action="controllers/editar_orden.php" method="post">
            <h5>Datos de la solicitud</h5>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <input class="form-control" value="<?php echo $orden["orderNum"] ?>" name="orden" type="text" placeholder="No. de Orden" required>
                    <input class="form-control" value="<?php echo $orden["id"] ?>"  name="id" type="hidden" placeholder="Version" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" value="<?php echo $orden["fecha"]?>" name="fecha" type="text" required>
                </div>
                <div class="col-md-12 mt-3">
                    <input class="form-control" value="<?php echo $orden['solicitadoPor']?>" name="solicitadopor" type="text" placeholder="Solicitado por" required>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="prioridades" id="">
                        <?php
                        if($orden["nivelPrioridad"]=='1'){
                            ?>
                                <option value="1">Prioridad media</option>
                                <option value="2">Prioridad Alta</option>
                                <option value="3">Prioridad Baja</option>
                            <?php
                        }
                        if($orden["nivelPrioridad"]=='2'){
                            ?>
                                <option value="2">Prioridad Alta</option>
                                <option value="1">Prioridad media</option>
                                <option value="3">Prioridad Baja</option>
                            <?php
                        }
                        if($orden["nivelPrioridad"]=='3'){
                            ?>
                                <option value="3">Prioridad Baja</option>
                                <option value="1">Prioridad media</option>
                                <option value="2">Prioridad Alta</option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="col-md-6 row mt-3">
                    <div class="col-md-10">
                        <a class="btn btn col-md-12" href="archivos/<?php echo $orden["documento"] ?>" download="<?php echo $orden["documento_original"] ?>">Descargar archivo</a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger col-md-12">X</button>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
                </div>
                <div class="col-md-6">
                    <a href="add_ejecutores_orden.php?id=<?php echo $orden["id"] ?>" class="btn btn-success col-md-12 mt-3 text-light"> Realizado por </a>
                </div>
            </div>
            
        </form>


    </div>
</div>