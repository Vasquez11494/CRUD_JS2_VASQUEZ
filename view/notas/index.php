<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

require '../../model/Alumno.php';

$Alumno = new Alumno();
$Alumnos = $Alumno->buscar();

include_once '../template/header.php'; ?>

<div class="row justify-content-center mt-3">
    <h1 class="text-center mt-3">Formulario para ingresar las notas</h1>
    <form action="../../controladores/notas/guardar.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6">
        <label for="alu_id" class="mb-2">Seleccione al Alumno</label>
        <select name="alu_id" id="alu_id" class="form-control mb-3" required>
            <option value="">SELECCIONE...</option>
            <?php foreach ($Alumnos as $alumno) : ?>
                <option value="<?= $alumno['alu_id'] ?>"> <?= $alumno['alu_nombre'] . ' ' . $alumno['alu_apellido'] ?></option>
            <?php endforeach ?>
        </select>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <table class="table table-bordered table-hover" id="tablaMaterias" >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nombre de la materia</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center" >No hay Materias registradas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mb-3 d-flex justify-content-center p-3">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-25 text-uppercase  shadow border-0">Ingresar Notas</button>
                <button type="button" id="BtnModificar" class="btn btn-warning w-25 text-uppercase  shadow border-0 me-5 d-none">Modificar</button>
                <button type="button" id="BtnCancelar" class="btn btn-secondary w-25 text-uppercase  shadow border-0 ms-5 d-none">Cancelar</button>
        </div>
    </form>
</div>

<script src="../../src/notas/notas.js"></script>
<script src="../../src/funciones.js"></script>
<?php include '../template/footer.php'; ?>