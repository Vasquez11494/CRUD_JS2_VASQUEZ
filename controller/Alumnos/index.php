<?php
require '../../model/Alumno.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    $mensaje = "";
    $codigo = 0;

    switch ($metodo) {
        case 'POST':
            if ($tipo === '1') {
                $Alumno = new Alumno($_POST);
                $ejecutar = $Alumno->guardar();
                $mensaje = "Alumno Guardado correctamente";
                $codigo = 1;
            } elseif ($tipo === "2") {
                $Alumno = new Alumno($_POST);
                $ejecutar = $Alumno->modificar();
                $mensaje = "Alumno Modificado correctamente";
                $codigo = 2;
            } elseif ($tipo === "3") {
                $Alumno = new Alumno($_POST);
                $ejecutar = $Alumno->eliminar();
                $mensaje = "Alumno Eliminado correctamente";
                $codigo = 3;
            } else {
                $mensaje = 'Tipo No encontrado';
                $codigo = 5;
            }
            break;

        case 'GET':
            $Alumno = new Alumno($_GET);
            $AlumnoNuevo = $Alumno->buscar();
            echo json_encode($AlumnoNuevo);
            exit;
            
        default:
            http_response_code(405);
            $mensaje = "Método no permitido";
            $codigo = 9;
            break;
    }

    echo json_encode([
        "mensaje" => $mensaje,
        "codigo" => $codigo
    ]);
} catch (Exception $e) {
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
}

exit;
