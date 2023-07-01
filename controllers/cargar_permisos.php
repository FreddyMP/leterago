<?php
 include("../model/rules.php");
 $new_rol = new Rules();

  $new_rol->permisos_default();

 header("location:../list_roles.php");
?>