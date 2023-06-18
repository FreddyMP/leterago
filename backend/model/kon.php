<?php
     include("../config/cone.php");

     class Kon{
            public function conn(){
                $cone = new Conexion();
                return $cone->conectar();
            }
     }

     
?>