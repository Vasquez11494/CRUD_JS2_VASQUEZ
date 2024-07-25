<?php

require_once 'Conexion.php';

class Grado extends Conexion
{

    public  $grad_id;
    public  $grad_nombre;



    public function __construct( $args = []){
        $this->grad_id = $args['grad_id'] ?? null ;
        $this->grad_nombre = $args['grad_nombre'] ?? '' ;
  
    }

    public function mostrarGrados (){
        $sql = "SELECT * FROM grados";

        $resultado =  self::servir($sql);
        return $resultado;
    }


}
