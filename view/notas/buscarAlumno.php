<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require '../template/header.php';
require '../../model/Alumno.php';

$alumno = new Alumno();
$alumnos = $alumno->buscar();


include_once '../templates/header.php'; ?>
<h1 class="text-center mt-3">Seleccione al Alumno para ver su Tarjeta de Calificaciones</h1>
<div class="row justify-content-center mt-3">
    <form action="/CRUD_JS2_VASQUEZ/view/notas/mostrarNotas.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="col">
            <label for="alu_id">Seleccione al Alumno</label>
            <select name="alu_id" id="alu_id" class="form-control form-control-sm" required>
                <option value="">SELECCIONE...</option>
                <?php foreach ($alumnos as $alumno) : ?>
                    <option value="<?= $alumno['alu_id'] ?>"> <?= $alumno['alu_nombre'].' '.$alumno['alu_apellido'] ?></option>
                <?php endforeach ?>  
            </select>
        </div>
        <div class="row justify-content-center mt-3">
            <button type="submit" class="btn btn-success">Ver Tarjeta de Calificaciones</button>
        </div>
    </form>
</div>
<?php include '../template/footer.php'; ?>