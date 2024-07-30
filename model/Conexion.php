<?php
abstract class Conexion 
{
    protected static $conexion = null;

    protected static function conectar(): PDO
    {
        try {
            self::$conexion = new PDO("informix:host=host.docker.internal; service=9088;database=tienda; server=informix; protocol=onsoctcp;EnableScrollableCursors=1", "informix", "in4mix");
            // self::$conexion = new PDO('mysql:host=host.docker.internal;port=3306;dbname=tienda', 'root', '');
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "CONEXION EXITOSA";
        } catch (PDOException $e) {
            echo "No hay conexion a la Base de Datos <br>";
            echo $e->getMessage();
            self::$conexion = null;
            exit;
        }
        return self::$conexion;
    }

    public function ejecutar($sql)
    {
        $conexion = self::conectar();
        $sentencia = $conexion->prepare($sql);
        $resultado = $sentencia->execute();
        $idInsertado = $conexion->lastInsertId();
        self::$conexion = null;

        return [
            "resultado" => $resultado,
            "id" => $idInsertado
        ];
    }

    public function servir($sql)
    {
        $conexion = self::conectar();
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $datos = [];
        foreach ($data as $k => $v) {
            $datos[] = array_change_key_case($v, CASE_LOWER);
        }
        self::$conexion = null;

        return $datos;
    }

    // Método para verificar la conexión
    public static function verificarConexion()
    {
        try {
            self::conectar();
            if (self::$conexion) {
                echo "Conexión exitosa a la base de datos.";
            }
        } catch (PDOException $e) {
            echo "No hay conexión a la base de datos. <br>";
            echo $e->getMessage();
        } finally {
            self::$conexion = null;
        }
    }
}
