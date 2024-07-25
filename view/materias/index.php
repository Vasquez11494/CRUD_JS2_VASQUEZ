<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include_once '../template/header.php'; ?>

<h1 class="text-center mt-3">Formulario para agregar Materias</h1>
<div class="row justify-content-center mt-3">
    <form class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
            <div class="col">
                <input type="hidden" name="materia_id" id="materia_id" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="materia_nombre">Nombre de la materia</label>
                <input type="text" name="materia_nombre" id="materia_nombre" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase fw-bold shadow border-0">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnBuscar" class="btn btn-info w-100 text-uppercase fw-bold shadow border-0">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnModificar" class="btn btn-warning w-100 text-uppercase fw-bold shadow border-0">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnCancelar" class="btn btn-secondary w-100 text-uppercase fw-bold shadow border-0">Cancelar</button>
            </div>
            <div class="col">
                <button type="reset" id="BtnLimpiar" class="btn btn-secondary w-100 text-uppercase fw-bold shadow border-0">Limpiar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center mt-4">
    <div class="col-lg-7 table-wrapper">
        <h2 class="text-center mb-4">Materias Registradas</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="AlumnosIngresados">
                <thead class="table-warning">
                    <tr>
                        <th>No.</th>
                        <th>Nombre de la Materia</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">No existen materias registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../../src/materias/materias.js"></script>
<script src="../../src/funciones.js"></script>

<?php include '../templates/footer.php'; ?>