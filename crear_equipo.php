<?php
    include("plantilla/menu_top.php"); 
    include("model/almacenes.php");
    include("model/ubicaciones.php");
    include("model/categorias.php");

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
    <h3>Crear equipo</h3>
    <div class="formularios">
        <form action="controllers/create_equipo.php" method="post">
            <div class="row">
            <div class="col-md-4 mt-3">
                    <input class="form-control" name="codigo" type="text" placeholder="Codigo" required>
                </div>
                <div class="col-md-8 mt-3">
                    <input class="form-control" name="description" type="text" placeholder="Descripcion" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="marca" type="text" placeholder="Marca" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="modelo" type="text" placeholder="Modelo" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="serie" type="text" placeholder="Serie" required>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="estado" id="">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="categoria" id="">
                        <?php 
                            while($row = mysqli_fetch_assoc($categorias)){
                        ?>
                        <option value="<?php echo $row["id"]?>"><?php echo $row["description"]?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                <select class="form-control" name="almacen" id="">
                    <?php
                        while($row = mysqli_fetch_assoc($almacenes)){
                    ?>
                        <option value="<?php echo $row["id"] ?>"><?php echo $row["description"] ?></option>
                    <?php
                        }
                     ?>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                <select class="form-control" name="ubicacion" id="">
                        <?php 
                            while($row = mysqli_fetch_assoc($ubicaciones)){
                        ?>
                        <option value="<?php echo $row["id"] ?>"><?php echo $row["description"] ?></option>
                        <?php
                        }
                     ?>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <select class="form-control" name="frecuencia" id="">
                        <option value="1">Mensual</option>
                        <option value="2">Bimensual</option>
                        <option value="3">Trimensual</option>
                        <option value="4">Cuatrimestral</option>
                        <option value="5">Semestral</option>
                        <option value="6">Anual</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <hr>
                    <input name="orden" type="checkbox"> Para ordenes
                </div>
                <div class="col-md-12 mt-3">
                    <textarea name="observaciones" class="form-control" placeholder="Observaciones" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>