<?php
    include("../model/rules.php");

     $rol = new Rules();

    echo $roles = $_POST["roles"];
    echo $id_rol = $_POST["id"];
    echo  $crear_rol = $_POST["crear_roles"];
    echo  $editar_rol = $_POST["editar_roles"];
    echo  $eliminar_rol = $_POST["eliminar_roles"];


    echo $usuarios = $_POST["usuarios"];
    echo  $crear_usuarios = $_POST["crear_usuarios"];
    echo  $editar_usuarios = $_POST["editar_usuarios"];
    echo  $eliminar_usuarios = $_POST["eliminar_usuarios"];

    $rol->update($id_rol, $roles, $crear_rol, $editar_rol, $eliminar_rol, $usuarios, $crear_usuarios, $editar_usuarios, $eliminar_usuarios);

    header("location:../list_roles.php");
?>