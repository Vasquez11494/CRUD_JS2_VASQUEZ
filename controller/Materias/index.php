<?php
require '../../model/Materia.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    $mensaje = "";
    $codigo = 0;

    switch ($metodo) {
        case 'POST':
            if ($tipo === '1') {
                $Materia = new Materia($_POST);
                $ejecucion = $Materia->guardar();
                $mensaje = "Materia ingresada correctamente";
                $codigo = 1;
            } elseif ($tipo === "2") {
                $Materia = new Materia($_POST);
                $ejecucion = $Materia->modificar();
                $mensaje = "Materia modificada correctamente";
                $codigo = 2;
            } elseif ($tipo === "3") {
                $Materia = new Materia($_POST);
                $ejecucion = $Materia->eliminar();
                $mensaje = "Materia eliminada correctamente";
                $codigo = 3;
            } else {
                $mensaje = 'Tipo No encontrado';
                $codigo = 5;
            }
            break;

        case 'GET':
            $Materia = new Materia($_GET);
            $ejecutar = $Materia->buscar();
            echo json_encode($ejecutar);
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
