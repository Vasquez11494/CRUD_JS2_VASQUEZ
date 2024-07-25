<?php

require_once 'Conexion.php';

class Arma extends Conexion
{

    public  $arm_id;
    public  $arm_nombre;



    public function __construct( $args = []){
        $this->arm_id = $args['arm_id'] ?? null ;
        $this->arm_nombre = $args['arm_nombre'] ?? '' ;
  
    }

    public function mostrarArmas (){
        $sql = "SELECT * FROM armas";

        $resultado =  self::servir($sql);
        return $resultado;
    }


}
