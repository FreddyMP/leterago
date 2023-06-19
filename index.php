<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/Top.css">
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js" ></script>
<script src="js/bootstrap.min.js" ></script>

<hgroup>
  <?php
    if(isset($_GET["Error_log"])){
  ?>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error de acceso!</h4>
      <p>Las credenciales no coinciden con los usuarios registrados, verifique e intente nuevamente <hr>
      <p class="mb-0">De no saber sus credenciales, comunicase con el administrador</p>
    </div>

<?php
    }
?>
  <h1><img width="300" src="imagen/logo.png" alt=""></h1>
  <h3>Mantenimiento</h3>
</hgroup>
<form method="post" action = "controllers/login.php">
    <link rel="stylesheet" href="css/login.css">
  <div class="group">
    <input type="text" name="username"><span class="highlight"></span><span class="bar"></span>
    <label>Name</label>
  </div>
  <div class="group">
    <input type="password" name="password"><span class="highlight"></span><span class="bar"></span>
    <label>Password</label>
  </div>
  <input type="submit" class="button buttonBlue" value = "Acceder"/>
   
  
</form>
<footer><a href="http://www.polymer-project.org/" target="_blank">
    <!--<img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>-->
  <p>Todos los derechos reservador @Leterago <!-- <a href="http://www.polymer-project.org/" target="_blank">Google</a>--></p>
</footer>

