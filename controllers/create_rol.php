<?php
 include("../model/rules.php");
 session_start();
 $new_rol = new Rules();

 $usuario_creator = $_SESSION["usuario_Log_Id"];
 $description = $_POST["descripcion"];

  $new_rol->create_rule($description,$usuario_creator);

 header("location:cargar_permisos.php");
?>