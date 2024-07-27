<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include_once '../template/header.php';
require '../../model/Arma.php';
require '../../model/Grado.php';

$buscarArmas = new Arma();
$armas = $buscarArmas->mostrarArmas();
$buscargrado = new Grado();
$grados = $buscargrado->mostrarGrados();

?>
<h1 class="text-center mt-3">Formulario para agregar Alumnos</h1>
<div class="row justify-content-center mt-3">
    <form class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
            <div class="col">
                <input type="hidden" name="alu_id" id="alu_id" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alu_nombre">Nombre del Alumno</label>
                <input type="text" name="alu_nombre" id="alu_nombre" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alu_apellido">Apellidos del Alumno</label>
                <input type="text" name="alu_apellido" id="alu_apellido" class="form-control" >
            </div>
        </div>
        <div class="col">
            <label for="alu_grado">Grado del Alumno</label>
            <select name="alu_grado" id="alu_grado" class="form-control" >
                <option value="">SELECCIONE...</option>
                <?php foreach ($grados as $grado) : ?>
                    <option value="<?= $grado['grad_id'] ?>"> <?= $grado['grad_nombre'] . ""  ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col mb-3">
            <label for="alu_arma">Arma del Alumno</label>
            <select name="alu_arma" id="alu_arma" class="form-control" >
                <option value="">SELECCIONE...</option>
                <?php foreach ($armas as $arma) : ?>
                    <option value="<?= $arma['arm_id'] ?>"> <?= $arma['arm_nombre'] . ""  ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alu_nacionalidad">Nacionalidad del Alumno</label>
                <input type="text" name="alu_nacionalidad" id="alu_nacionalidad" class="form-control" placeholder="Ej. Guatemalteco" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase shadow border-0">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnBuscar" class="btn btn-info w-100 text-uppercase shadow border-0">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnModificar" class="btn btn-warning w-100 text-uppercase shadow border-0">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnCancelar" class="btn btn-secondary w-100 text-uppercase shadow border-0">Cancelar</button>
            </div>
            <div class="col">
                <button type="reset" id="BtnLimpiar" class="btn btn-secondary w-100 text-uppercase shadow border-0">Limpiar</button>
            </div>
        </div>
    </form>
</div>
<!-- MOSTRAR DATOS -->
<div class="row justify-content-center mt-4">
    <div class="col-lg-10 table-wrapper">
        <h2 class="text-center mb-4">Alumnos Ingresados</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="AlumnosIngresados">
                <thead class="table-warning" >
                    <tr>
                        <th >No.</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Grado</th>
                        <th>Arma</th>
                        <th>Nacionalidad</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center">No hay Alumnos Registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- js -->
<script src="../../src/alumnos/alumnos.js"></script>
<script src="../../src/funciones.js"></script>
<?php include '../template/footer.php'; ?>