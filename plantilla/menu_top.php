<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/Top.css">
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js" ></script>
<script src="js/jquery.js" ></script>

<?php
session_start();
if(isset($_SESSION["usuario_Log_Username"])){
  include("model/users.php");  
  include("model/calendario.php"); 
  $Users_instance = new Users();
  $permisos = $Users_instance->permisos();

  $calendario_instance = new Calendario();

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php"><img id="logo" src="imagen/logo.png" alt=""> <small class='small_relleno'>V.1.1</small></a>
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
          <a class="dropdown-item" href="list_programas.php">Programas</a>
           <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="crear_programas.php">Crear programa</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="list_calendario.php">Calendario</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mantenimiento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="list_mantenimientos.php">Reportes de mantenimiento</a>
          <div class="dropdown-divider"></div>
         <!-- <a class="dropdown-item" href="crear_mantenimiento.php">Crear mantenimiento</a>
          <div class="dropdown-divider"></div> -->
          <a class="dropdown-item" href="list_ordenes.php">Ordenes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="crear_ordenes.php">Crear Ordenes</a>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Equipos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="list_equipos.php">Equipos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="crear_equipo.php">Crear equipos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="list_actividades.php">Actividades</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="crear_actividades.php">Crear actividades</a>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categorias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="list_categorias.php">Categorias</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="crear_categorias.php">Crear categorias</a>
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
          <div class="dropdown-divider"></div>
          <?php
           }
           if($permisos["Modulo_Almacenes"] == 1 || $permisos["Modulo_Roles"]== 1){
            ?>
          <a class="dropdown-item" href="create_almacen.php">Crear almacenes</a>
          <div class="dropdown-divider"></div>
            <?php
           }
            ?>
            <a class="dropdown-item" href="list_ubicaciones.php">Ubicaciones</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="crear_ubicacion.php">Crear ubicaciones</a>
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
              <div class="dropdown-divider"></div>
          <?php
           }
           if($permisos["Crear_Modulo_Usuarios"] == 1){
            ?>
          <a class="dropdown-item" href="create_users.php">Crear usuario</a>
          <div class="dropdown-divider"></div>
          <?php
           }
           if($permisos["Crear_Modulo_Roles"] == 1){
            ?>
          <a class="dropdown-item" href="create_roles.php">Crear rol</a>
          <div class="dropdown-divider"></div>
          <?php
           }
           if($permisos["Modulo_Roles"] == 1){
            ?>
            <a class="dropdown-item" href="list_roles.php">Roles</a>
            <?php
           }
          ?>
         
        </div>
      </li>
      <?php }?>
    </ul>
    <ul class="navbar-nav mr-2 float-right">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle bg-danger notificaciones" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          10
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
     
          <a class="dropdown-item" href="list_tareas.php">
            <span class="bg-info notificaciones   ml-2 text-light pl-3 pr-3 pt-1 pb-1">
            <?php 
              echo $cantidad = $calendario_instance->contadores(2);
            ?>
            </span>
            Para hoy
          </a>
      
         
          <a class="dropdown-item" href="list_tareas.php">
          <span class="bg-warning notificaciones ml-2 text-light pl-3 pr-3 pt-1 pb-1"> 
            <?php 
              echo $cantidad = $calendario_instance->contadores(3);
            ?>
          </span>
          Proximos</a>
     
          <a class="dropdown-item" href="list_tareas.php">
          <span class="bg-danger notificaciones ml-2 text-light pl-3 pr-3 pt-1 pb-1">
            <?php 
              echo $cantidad = $calendario_instance->contadores(1);
            ?>
          </span>
          En atraso</a>

        </div>
      </li>
      </ul>
       <img src="imagen/bell.png" width="25" srcset="">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php
         echo $_SESSION["usuario_Log_Username"];
         ?> <a href="controllers/logout.php">Salir</a>
        </a>
  </div>
</nav>

<?php
}else{
  header("location:index.php");
}
?>