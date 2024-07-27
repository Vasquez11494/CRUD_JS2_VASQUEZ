<?php

require_once 'Conexion.php';

class Materia extends Conexion{

    public $materia_id;
    public $materia_nombre;
    public $materia_situacion;

    public function __construct( $args = [])
    {
        $this->materia_id = $args['materia_id'] ?? null;
        $this->materia_nombre = $args['materia_nombre'] ?? '';
        $this->materia_situacion = $args['materia_situacion'] ?? '';
    }
    
    
    public function guardar()
    {
        $sql = "INSERT into materias (materia_nombre) values ('$this->materia_nombre')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT materia_id, materia_nombre FROM materias WHERE materia_situacion = 1 ";

        if ($this->materia_nombre != '') {
            $sql .= " AND materia_nombre like '%$this->materia_nombre%' ";
        }

        // echo json_encode($sql);
        // exit;
        $resultado = self::servir($sql);
        return $resultado;
    }

    
    public function modificar(){
        $sql = "UPDATE materias SET materia_nombre = '$this->materia_nombre' WHERE materia_situacion = 1 AND materia_id= $this->materia_id ";
  
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
        
    public function eliminar(){
        $sql = "UPDATE materias SET materia_situacion = 0 WHERE materia_id = $this->materia_id ";

        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }

    public function NotasAlumno($ID)
    {

        $sql = "SELECT materia_nombre, nota from notas INNER JOIN materias ON  nota_materia_id = materia_id WHERE nota_alu_id = $ID ";
        $resultado =  self::servir($sql);
        return $resultado;
    }

    

}
