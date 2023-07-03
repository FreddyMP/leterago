<?php
    include("../model/rules.php");

    $rol = new Rules();

    $roles = $_POST["roles"];
    $id_rol = $_POST["id"];
    $crear_rol = $_POST["crear_roles"];
    $editar_rol = $_POST["editar_roles"];
    $eliminar_rol = $_POST["eliminar_roles"];

    $usuarios = $_POST["usuarios"];
    $crear_usuarios = $_POST["crear_usuarios"];
    $editar_usuarios = $_POST["editar_usuarios"];
    $eliminar_usuarios = $_POST["eliminar_usuarios"];

    $description = $_POST["descripcion"];

    $rol->update($description, $id_rol, $roles, $crear_rol, $editar_rol, $eliminar_rol, $usuarios, $crear_usuarios, $editar_usuarios, $eliminar_usuarios);

    header("location:../list_roles.php");
?>