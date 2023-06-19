<?php
 include("../model/rules.php");
 session_start();
 $new_rol = new Rules();

 $usuario_creator = $_SESSION["usuario_Log_Id"];
 $description = $_POST["descripcion"];

 echo $new_rol->create_rule($description,$usuario_creator);
 echo $new_rol->permisos_default();

 header("location:../list_roles.php");
?>