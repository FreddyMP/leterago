<?php
    include("plantilla/menu_top.php"); 
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
    <h3>Crear nuevo usuario</h3>
    <div class="formularios">
        <form action="controllers/create_users.php" method="post">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="username" type="text" placeholder="Usuario" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="password" type="text" placeholder="Clave" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="name" type="text" placeholder="Nombre" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="lastname" type="text" placeholder="Apellido" required>
                </div>
                <div class="col-md-12 mt-3">
                    <select class="form-control" name="rol" id="">
                        <?php
                            while ($row = mysqli_fetch_assoc($exc_query)) {
                                ?>
                                    <option value="<?php echo $row["id"] ?>"><?php echo $row["description"]?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <input class="btn btn-info col-md-12 mt-3" type="submit" value="Guardar">
        </form>
    </div>
</div>