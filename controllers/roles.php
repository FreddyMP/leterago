<?php

    include_once("../backend/model/rules.php");

    $lista_rol = new Rules();

    while($row = mysqli_fetch_assoc($lista_rol->List())){
        echo $row["id"];
    }
 ?>