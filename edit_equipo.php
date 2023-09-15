<?php
    include("plantilla/menu_top.php"); 
    include("model/almacenes.php");
    include("model/ubicaciones.php");
    include("model/categorias.php");
    include("model/equipos.php");

    $id = $_GET["id"];
    $equipos_instance = new Equipos();
    $equipos = $equipos_instance->find($id);

    $almacenes_instance = new Almacenes();
    $almacenes = $almacenes_instance->list();

    $categorias_instance = new Categorias();
    $categorias = $categorias_instance->list();

    $ubicaciones_instance = new Ubicaciones();
    $ubicaciones = $ubicaciones_instance->list();
    
?>
<link rel="stylesheet" href="css/form.css">
<div class="Container"><br>
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
    <h3>Editar equipo</h3>
    <div class="formularios">
        <form action="controllers/editar_equipo.php" method="post">
            <div class="row">
            <div class="col-md-4 mt-3">
                    <input type="hidden" name="id" value="<?php echo $equipos["id"] ?>">
                    <input class="form-control" name="codigo" value="<?php echo $equipos["codigo"] ?>" type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-8 mt-3">
                    <input class="form-control" name="description" value="<?php echo $equipos["description"] ?>" type="text" placeholder="Descripcion" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="marca" value="<?php echo $equipos["marca"] ?>" type="text" placeholder="Marca" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="modelo" value="<?php echo $equipos["modelo"] ?>" type="text" placeholder="Modelo" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="serie" value="<?php echo $equipos["serie"] ?>" type="text" placeholder="Serie" required>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="estado" id="">
                        <?php
                            if($equipos["estado"]=='Activo'){
                        ?>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                        <?php
                            }else{
                        ?>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Activo">A    ctivo</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="categoria" id="">
                        <?php 
                            $get_description = new Categorias();
                            $description = $get_description->find($equipos["id_categoria"]);
                            ?>
                            <option value="<?php echo $description["id"]?>"><?php echo $description["description"]?></option>
                            <?php
                            while($row = mysqli_fetch_assoc($categorias)){
                                if($description["id"] != $row["id"]){
                        ?>
                        <option value="<?php echo $row["id"]?>"><?php echo $row["description"]?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                
                <div class="col-md-6 mt-3">
                <select class="form-control" name="ubicacion" id="">
                        <?php 
                            $get_description = new Ubicaciones();
                            $description = $get_description->find($equipos["ubicacion"]);
                        ?>
                            <option value="<?php echo $description["id"]?>"><?php echo $description["description"]?></option>
                        <?php
                            while($row = mysqli_fetch_assoc($ubicaciones)){
                                if($description["id"] != $row["id"]){
                        ?>
                                <option value="<?php echo $row["id"] ?>"><?php echo $row["description"] ?></option>
                        <?php
                            }
                        }
                     ?>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="frecuencia" id="">
                            <?php 
                            if($row['frecuencia']== 1){
                                ?>
                                    <option value="1">Mensual</option>
                                    <option value="2">Bimensual</option>
                                    <option value="3">Trimestral</option>
                                    <option value="4">Cuatrimestral</option>
                                    <option value="5">Semestral</option>
                                    <option value="6">Anual</option>
                                <?php
                            }
                            
                            if($equipos['frecuencia']== 2){
                                ?>
                                    <option value="2">Bimensual</option>
                                    <option value="1">Mensual</option>
                                    <option value="3">Trimestral</option>
                                    <option value="4">Cuatrimestral</option>
                                    <option value="5">Semestral</option>
                                    <option value="6">Anual</option>
                                <?php
                            } 
                            if($equipos['frecuencia']== 3){
                                ?>
                                    <option value="3">Trimestral</option>
                                    <option value="1">Mensual</option>
                                    <option value="2">Bimensual</option>
                                    <option value="4">Cuatrimestral</option>
                                    <option value="5">Semestral</option>
                                    <option value="6">Anual</option>
                                <?php
                            }
                     
                            if($equipos['frecuencia']== 4){
                                ?>
                                    <option value="4">Cuatrimestral</option>
                                    <option value="1">Mensual</option>
                                    <option value="2">Bimensual</option>
                                    <option value="3">Trimestral</option>
                                    <option value="5">Semestral</option>
                                    <option value="6">Anual</option>
                                <?php
                            }
                        
                            if($equipos['frecuencia']== 5){
                                ?>
                                    <option value="5">Semestral</option>
                                    <option value="1">Mensual</option>
                                    <option value="2">Bimensual</option>
                                    <option value="3">Trimestral</option>
                                    <option value="4">Cuatrimestral</option>
                                    <option value="6">Anual</option>
                                <?php
                            }
                     
                            if($equipos['frecuencia']== 6){
                                ?>
                                    <option value="6">Anual</option>
                                    <option value="1">Mensual</option>
                                    <option value="2">Bimensual</option>
                                    <option value="3">Trimestral</option>
                                    <option value="4">Cuatrimestral</option>
                                    <option value="5">Semestral</option>
                                <?php
                            }
                  
                            if($equipos['frecuencia']== 0){
                                ?> 
                                    <option value="0">--Seleccion--</option>
                                    <option value="1">Mensual</option>
                                    <option value="2">Bimensual</option>
                                    <option value="3">Trimestral</option>
                                    <option value="4">Cuatrimestral</option>
                                    <option value="5">Semestral</option>
                                    <option value="6">Anual</option>
                                <?php
                            }
                            ?>
                        
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <hr>
              
                    <input name="orden"<?php if($equipos["orden"] == 1){?> checked <?php }?> type="checkbox"> Para ordenes
        
                </div>
                <div class="col-md-12 mt-3">
                    <textarea name="observaciones" class="form-control" placeholder="Observaciones" id="" cols="30" rows="10"><?php echo $equipos["observaciones"] ?></textarea>
                </div>
            </div>
            <input class="btn btn-info col-md-3 mt-3" type="submit" value="Guardar">
            <a href="add_actividades.php?id=<?php echo $id ?>" class="btn btn-primary col-md-3 text-light mt-3">Agregar actividades</a>
            <a href="list_mantenimientos_equipo.php?id=<?php echo $id ?>" class="btn btn-success col-md-3 text-light mt-3">Reportes</a>
        </form>
    </div>
</div>