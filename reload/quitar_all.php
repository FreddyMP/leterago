<?php
    include_once("../model/programas.php");

    $programa_instance = new Programas();

    $id = $_GET["id"];
    $programa = $programa_instance->quitar_all($id);

    header("location:../edit_programa.php?id=$id");
    
?>