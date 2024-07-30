<?php
require '../../model/Materia.php';
require '../../model/Nota.php';

header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    $mensaje = "";
    $codigo = 0;

    switch ($metodo) {
        case 'POST':
            if ($tipo === '1') {

                $nota_alu_id = filter_var($_POST['alu_id'], FILTER_VALIDATE_INT);
                $_POST['nota'] =array_filter($_POST['nota']);
        
                $notas = $_POST['nota'];
        
         
                foreach ($notas as $materia_id => $nota) {
                    // Filtrar y validar materia_id
                    $materia_id = filter_var($materia_id, FILTER_VALIDATE_INT);
                    if ($materia_id === false || $materia_id <= 0) {
                        die("ID de materia no es válido para $materia_id");
                    }
            
                    // Filtrar y validar nota
                    $nota = filter_var($nota, FILTER_VALIDATE_FLOAT);
                    if ($nota === false || $nota < 0 || $nota > 100) {
                        die("Nota no es válida para materia $materia_id. Debe estar entre 0 y 100");
                    }
            
                    // Crear la instancia de Nota y guardar
                    $GuardarNotas = new Notas([
                        'nota_alu_id' => $nota_alu_id,
                        'nota_materia_id' => $materia_id,
                        'nota' => $nota
                    ]);
            
                    // Guardar la nota
                    $Notaguardardada = $GuardarNotas->guardar();
                }

                $mensaje = "Notas ingresadas correctamente";
                $codigo = 1;
            } elseif ($tipo === "2") {
                $Notas = new Notas($_POST);
                $ejecucion = $Notas->tieneNotas($_POST['nota_alu_id']);
                echo json_encode($ejecucion);
                exit;
            }
            break;

        case 'GET':
            if ($tipo === '1') {
                $Materia = new Materia($_GET);
                $ejecutar = $Materia->buscar();
                echo json_encode($ejecutar);
                exit;
            }
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
