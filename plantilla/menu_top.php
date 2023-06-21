<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/Top.css">
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js" ></script>
<script src="js/bootstrap.min.js" ></script>
<?php
session_start();

if(isset($_SESSION["usuario_Log_Username"])){
  include("config/cone.php");  
  //Conexion
    $con = new Conexion();

    $permisos_con = $con->conectar();
    $id_log = $_SESSION["usuario_Log_Rol"];

    $query_permisos = "SELECT * from rolpermisos where id_Rol = $id_log";
    $exc_permisos = mysqli_query($permisos_con,$query_permisos);
    $permisos = mysqli_fetch_assoc($exc_permisos);

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img id="logo" src="imagen/logo.png" alt=""> <small class='small_relleno'>V.1.1</small></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Programacion
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mantenimiento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Actividades
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categorias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Almacenes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
           if($permisos["Modulo_Almacenes"] == 1){
            ?>
          <a class="dropdown-item" href="list_almacenes.php">Almacenes</a>
          <?php
           }
           if($permisos["Modulo_Almacenes"] == 1 || $permisos["Modulo_Roles"]== 1){
            ?>
          <a class="dropdown-item" href="create_almacen.php">Crear almacenes</a>
            <?php
           }
            ?>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <?php
           if($permisos["Modulo_Usuarios"] == 1 || $permisos["Modulo_Roles"]== 1){
            ?>
      <li class="nav-item dropdown">
        
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
           
           if($permisos["Modulo_Usuarios"] == 1){
            ?>
              <a class="dropdown-item" href="list_usuarios.php">Usuarios</a>
          <?php
           }
           if($permisos["Crear_Modulo_Usuarios"] == 1){
            ?>
          <a class="dropdown-item" href="create_users.php">Crear usuario</a>
          <?php
           }
           if($permisos["Crear_Modulo_Roles"] == 1){
            ?>
          <a class="dropdown-item" href="create_roles.php">Crear rol</a>
          <?php
           }
           if($permisos["Modulo_Roles"] == 1){
            ?>
            <a class="dropdown-item" href="list_roles.php">Roles</a>
            <?php
           }
          ?>
         
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <?php }?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php
         echo $_SESSION["usuario_Log_Username"];
         ?> <a href="controllers/logout.php">Salir</a>
        </a>
    </form>
  </div>
</nav>

<?php
}else{
  header("location:index.php");
}
?>