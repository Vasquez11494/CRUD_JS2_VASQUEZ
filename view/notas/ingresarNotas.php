<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

require '../../modelos/Alumno.php';
require '../../modelos/Materia.php';
require '../../modelos/Nota.php';

$_POST['alu_id'] = filter_var($_POST['alu_id'], FILTER_SANITIZE_NUMBER_INT);

$AlumnoSeleccionado = new Alumno();
$Alumno = $AlumnoSeleccionado->buscar($_POST['alu_id']);

$materia = new Materia();
$materias = $materia->buscar();

$Estalleno = new Notas();
$TieneNotas = $Estalleno->tieneNotas($_POST['alu_id']);

$notasObtenidas = [];
foreach ($TieneNotas as $nota) {
    $notasObtenidas[$nota['nota_materia_id']] = $nota['nota'];
}

// echo "<pre>";
// print_r($TieneNotas);
// echo "</pre>";

include_once '../templates/header.php'; ?>

<div class="row justify-content-center mt-3">
<?php if (count($TieneNotas) > 0) : ?>
    <h1 class="text-center mt-3">Modificar las Notas del Alumno</h1>
    <form action="../../controladores/notas/modificar.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="col">
            <input type="hidden" name="alu_id" id="alu_id" value="<?= $Alumno['alu_id'] ?>" class="form-control">
        </div>
        <div class="col">
            <label for="alu_nombre">Igrese las notas de:</label>
            <input type="text" name="alu_nombre" id="alu_nombre" value="<?= $Alumno['alu_nombre'] . " " . $Alumno['alu_apellido'] ?>" class="form-control" readonly required>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nombre de la materia</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($materias) > 0) : ?>
                            <?php foreach ($materias as $key => $value) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['materia_nombre'] ?></td>
                                    <td class="text-center">
                                    <input type="number" name="notas[<?= $value['materia_id'] ?>]" class="form-control form-control-sm w-50 mx-auto" step="0.01" required min="0" max="100" value="<?= isset($notasObtenidas[$value['materia_id']]) ? $notasObtenidas[$value['materia_id']] : '' ?>">
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">No hay Materias registradas</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-warning">MODIFICAR NOTAS</button>
            </div>
            <div class="col-auto">
                <a href="../../vistas/notas/index.php" class="btn btn-danger">CANCELAR</a>
            </div>
        </div>
    </form>
<?php  else : ?>
    <h1 class="text-center mt-3">Formulario para ingresar las notas</h1>
    <form action="../../controladores/notas/guardar.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="col">
            <input type="hidden" name="alu_id" id="alu_id" value="<?= $Alumno['alu_id'] ?>" class="form-control">
        </div>
        <div class="col">
            <label for="alu_nombre">Igrese las notas de:</label>
            <input type="text" name="alu_nombre" id="alu_nombre" value="<?= $Alumno['alu_nombre'] . " " . $Alumno['alu_apellido'] ?>" class="form-control" readonly required>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nombre de la materia</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($materias) > 0) : ?>
                            <?php foreach ($materias as $key => $value) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['materia_nombre'] ?></td>
                                    <td class="text-center">
                                        <input type="number" name="notas[<?= $value['materia_id'] ?>]" class="form-control form-control-sm w-50 mx-auto" step="0.01" required min="0" max="100">
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">No hay Materias registradas</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">INGRESAR NOTAS</button>
            </div>
            <div class="col-auto">
                <a href="../../vistas/notas/index.php" class="btn btn-danger">CANCELAR</a>
            </div>
        </div>
    </form>
</div>
<?php endif; ?>
</div>
<?php include '../templates/footer.php'; ?>