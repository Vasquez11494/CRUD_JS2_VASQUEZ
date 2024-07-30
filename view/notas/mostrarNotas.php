<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

require '../template/header.php';
require '../../model/Alumno.php';
require '../../model/Nota.php';
require '../../model/Materia.php';

$_POST['alu_id'] = filter_var($_POST['alu_id'], FILTER_SANITIZE_NUMBER_INT);

$AlumnoSeleccionado = new Alumno();
$Alumno = $AlumnoSeleccionado->informacionAlumno($_POST['alu_id']);


$notas = new Materia();
$NotasAlumno = $notas->NotasAlumno($_POST['alu_id']);

?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card mb-3">
            <h3 class="card-header text-center">Datos del Alumno</h3>
            <div class="card-body">
                <p class="card-text"><strong>Nombre:</strong> <?= $Alumno['nombre_completo'] ?></p>
                <p class="card-text"><strong>Grado:</strong> <?= $Alumno['grad_nombre'] ?></p>
                <p class="card-text"><strong>Arma:</strong> <?= $Alumno['arm_nombre'] ?></p>
                <p class="card-text"><strong>Nacionalidad:</strong> <?= $Alumno['alu_nacionalidad'] ?></p>
            </div>
        </div>
        <div class="card">
            <h3 class="card-header text-center">Notas del Alumno</h3>
            <div class="card-body">
                <?php if (count($NotasAlumno) > 0) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Materia</th>
                                <th>Nota</th>
                                <th>GANÓ/PERDIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($NotasAlumno as $key => $calificacion) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $calificacion['materia_nombre'] ?></td>
                                    <td><?= $calificacion['nota'] ?></td>
                                    <td><?= ($calificacion['nota'] > 70) ? 'GANÓ' : 'PERDIÓ' ?></td>
                                </tr>
                                <?php  $suma_notas += $calificacion['nota']; ?>
                            <?php endforeach ;
                            $cantidad_materias = count($NotasAlumno);
                            $promedio = $cantidad_materias > 0 ? $suma_notas / $cantidad_materias : 0;?>
                        </tbody>
                    </table>
                    <p class="text-center"><strong>Promedio:</strong> <?= number_format($promedio, 2) ?></p>
                <?php else : ?>
                    <p class="card-text text-center">No hay notas registradas para este alumno.</p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php require '../template/footer.php' ?>