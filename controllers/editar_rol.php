<?php
    include("../model/rules.php");

     $rol = new Rules();

    echo $roles = $_POST["roles"];
    echo $id_rol = $_POST["id"];
    echo  $crear_rol = $_POST["crear_roles"];
    echo  $editar_rol = $_POST["editar_roles"];
    echo  $eliminar_rol = $_POST["eliminar_roles"];

    $rol->update($id_rol, $roles, $crear_rol, $editar_rol, $eliminar_rol);

    header("location:../list_roles.php");
?>