<?php

require_once 'Conexion.php';

class Alumno extends Conexion
{

    public  $alu_id;
    public  $alu_nombre;
    public  $alu_apellido;
    public  $alu_grado;
    public  $alu_arma;
    public  $alu_nacionalidad;
    public  $alu_situacion;


    public function __construct($args = [])
    {
        $this->alu_id = $args['alu_id'] ?? null;
        $this->alu_nombre = $args['alu_nombre'] ?? '';
        $this->alu_apellido = $args['alu_apellido'] ?? '';
        $this->alu_grado = $args['alu_grado'] ?? '';
        $this->alu_arma = $args['alu_arma'] ?? '';
        $this->alu_nacionalidad = $args['alu_nacionalidad'] ?? '';
        $this->alu_situacion = $args['alu_sitacuion'] ?? 1;
    }

    public function guardar()
    {
        $sql = "INSERT into alumnos (alu_nombre, alu_apellido, alu_grado, alu_arma, alu_nacionalidad) values ('$this->alu_nombre','$this->alu_apellido','$this->alu_grado','$this->alu_arma','$this->alu_nacionalidad')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT alu_id, alu_nombre, alu_apellido, alu_grado, alu_arma, grad_nombre, arm_nombre, alu_nacionalidad FROM alumnos INNER JOIN grados ON alu_grado = grad_id INNER JOIN armas ON alu_arma = arm_id WHERE alu_situacion = 1 ";

        if ($this->alu_nombre != '') {
            $sql .= " AND alu_nombre like '%$this->alu_nombre%' ";
        }
        if ($this->alu_apellido != '') {
            $sql .= " AND alu_apellido like '%$this->alu_apellido%' ";
        }
        if ($this->alu_grado != '') {
            $sql .= " AND alu_grado = $this->alu_grado ";
        }
        if ($this->alu_arma != '') {
            $sql .= " AND alu_arma = $this->alu_arma ";
        }
        if ($this->alu_nacionalidad != '') {
            $sql .= " AND alu_nacionalidad = $this->alu_nacionalidad ";
        }
        

        // echo json_encode($sql);
        // exit;
        $resultado = self::servir($sql);
        return $resultado;
    }

    public function informacionAlumno($ID)
    {

        $sql = "SELECT alu_id, alu_nombre || ' ' || alu_apellido AS nombre_completo,  grad_nombre, arm_nombre, alu_nacionalidad FROM alumnos INNER JOIN grados ON alu_grado = grad_id INNER JOIN armas ON alu_arma = arm_id WHERE alu_situacion = 1 AND alu_id = $ID ";
        $resultado =  array_shift(self::servir($sql));
        return $resultado;
    }
    public function buscarId($id){
            
        $sql = "SELECT * FROM alumnos  where alu_situacion = 1 AND alu_id = $id ";

        // echo $sql;
        // exit;
        $resultado =  array_shift(self::servir($sql));
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE ALUMNOS SET alu_nombre = '$this->alu_nombre', alu_apellido = '$this->alu_apellido', alu_grado = '$this->alu_grado', alu_arma = '$this->alu_arma' , alu_nacionalidad = '$this->alu_nacionalidad' WHERE alu_situacion = 1 AND alu_id = $this->alu_id ";
  
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }

    public function eliminar(){
        $sql = " UPDATE alumnos SET alu_situacion = 0 WHERE alu_id = $this->alu_id ";

        $resultado = $this->ejecutar($sql);
        return $resultado;
    }
}
