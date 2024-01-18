<?php
    include("plantilla/menu_top.php"); 
    include("model/rules.php");

    $id= $_GET["id"];

    $usuario_instance = new Users();
    $usuario = $usuario_instance->find($id);

    $rule_id = $usuario["id_rol"];
    $Rules_instance = new Rules();
    $rol = mysqli_fetch_assoc($Rules_instance->find($rule_id));
    $exc_query = $Rules_instance->list();


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
    <h3>Editar usuario</h3>
    <div class="formularios">
        <form action="controllers/editar_users.php" method="post">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <input class="form-control" value="<?php echo $usuario["username"] ?>" name="username" type="text" placeholder="Usuario" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="password" type="password" placeholder="Clave" required>
                </div>
                <div class="col-md-6 mt-3">
                <input  type="hidden" name="id" value="<?php echo $id ?>" >

                    <input class="form-control" name="name" value="<?php echo $usuario["name"] ?>" type="text" placeholder="Nombre" required>
                </div>
                <div class="col-md-6 mt-3">
                    <input class="form-control" name="lastname" value="<?php echo $usuario["lastname"] ?>" type="text" placeholder="Apellido" required>
                </div>
                <div class="col-md-12 mt-3">
                    <select class="form-control" name="rol" id="">
                        <option value="<?php echo $rol["id"] ?>"><?php echo $rol["description"]?></option>
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