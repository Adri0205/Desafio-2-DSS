<?php 
 
class Model{ 
    public $con;
    public $conexion;
 
    function __construct(){
          $this->con= new Conexion();
        
    } 

}
?>