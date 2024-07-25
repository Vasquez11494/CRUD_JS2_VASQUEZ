<?php

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

require_once 'Conexion.php';

class Notas extends Conexion
{

    public  $nota_id;
    public  $nota_alu_id;
    public  $nota_materia_id;
    public  $nota;
    


    public function __construct($args = [])
    {
        $this->nota_id = $args['nota_id'] ?? null;
        $this->nota_alu_id = $args['nota_alu_id'] ?? '';
        $this->nota_materia_id= $args['nota_materia_id'] ?? '';
        $this->nota= $args['nota'] ?? '';
     
    }   

    public function guardar()
    {
        $sql = "INSERT into notas (nota_alu_id, nota_materia_id, nota) values ('$this->nota_alu_id', '$this->nota_materia_id', '$this->nota')";

        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function tieneNotas($id){
            
        $sql = "SELECT * FROM notas  where nota_alu_id = $id ";

        // echo $sql;
        // exit;
        $resultado =  self::servir($sql);
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE notas SET nota = '$this->nota' WHERE nota_alu_id= $this->nota_alu_id AND  nota_materia_id = '$this->nota_materia_id'";

        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }


}
