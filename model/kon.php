<?php

     class Kon{
        public $host = "localhost";
        public $db_name = "leterago";
        public $user_name= "root";
        public $password = "";
        
            public function conn(){
                try {
                    $cone = new mysqli($this->host, $this->user_name, $this->password, $this->db_name);
                    return $cone;
                } catch (\Throwable $th) {
                    echo "no conecto";
                }
                
            }
     }

     
?>