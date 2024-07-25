<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>INICIO</title>
    <style>
        .hero-section {
            background: url('../../src/images/fondo_aplicacion.jpg') no-repeat center center/cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
        }

        .hero-section .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-section .content {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }

        .features-icon {
            font-size: 3rem;
            color: #007bff;
        }

        #informacion {
            background-color: rgba(46, 45, 45, 0.5);
            /* Fondo semi-transparente */
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <?php include '../template/navbar.php'; ?>
    <div class="hero-section">
        <div class="overlay"></div>
        <div class="container content" id="informacion">
            <h1>Bienvenido al Sistema de Gestión de Notas</h1>
            <p>Escuela de Informática y Tecnología</p>
            <a href="/final_vasquez/vistas/alumnos/index.php" class="btn btn-primary btn-lg me-3">Agregar Alumnos</a>
            <a href="/final_vasquez/vistas/materias/index.php" class="btn btn-secondary btn-lg me-3">Agregar Materias</a>
            <a href="/final_vasquez/vistas/notas/index.php" class="btn btn-success btn-lg">Agregar Notas</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Características del Sistema</h2>
        <div class="row text-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-person-plus features-icon mb-3"></i>
                        <h5 class="card-title">Gestión de Alumnos</h5>
                        <p class="card-text">Agrega y administra la información de los alumnos de manera eficiente.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-book features-icon mb-3"></i>
                        <h5 class="card-title">Gestión de Materias</h5>
                        <p class="card-text">Administra las materias que se impartirán en cada curso.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-file-earmark-arrow-up features-icon mb-3"></i>
                        <h5 class="card-title">Gestión de Notas</h5>
                        <p class="card-text">Registra y actualiza las calificaciones de los alumnos fácilmente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-5 py-4 bg-dark text-white">
        <div class="container">
            <p>&copy; 2024 Escuela de Informática y Tecnología. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>