<?php
    include("plantilla/menu_top.php");
    include("model/categorias.php");
    $Categoria_instance = new Categorias();

    $categoria = $Categoria_instance->list();

?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
<?php
    if(isset($_GET["error_delete"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error de eliminacion!</h4>
      <p>No puede eliminar roles que esten vinculados a usuarios<hr>
      <p class="mb-0">Si el usuario no existe y el error persiste escriba a su suplidor</p>
    </div>

<?php
    }
?>
    <br>
    <h3>Categorias</h3>
    <div class="formularios">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    while($row = mysqli_fetch_assoc($categoria)){
  ?>
    <tr>
      <th scope="row"><?php echo $row["codigo"] ?></th>
      <td><?php echo $row["description"] ?></td>
      <td>
            <a href="edit_categorias.php?id=<?php echo $row['id']?>"><button class="btn btn-warning">Editar</button></a>
            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $row['id'] ?>">Eliminar</button>
      </td>
    </tr>
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Seguro que desea eliminar la categoria: <?php echo $row["description"] ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="controllers/delete_categorias.php?id=<?php echo $row['id']?>" type="button" class="btn btn-danger">Borrar</a>
      </div>
    </div>
  </div>
</div>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>
</div>
