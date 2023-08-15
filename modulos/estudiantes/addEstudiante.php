<?php
    include_once("../../config/Config.php");
    session_start();
    $role = $_SESSION['sess_userrole'];

    if (!isset($_SESSION['sess_username'])) {
        header("Location: " . ROOT . "index.php?mensaje=2");
    } elseif ($role != $roles['docente'] && $role != $roles['administrador']) {
        session_destroy();
        header("Location: " . ROOT . "index.php?mensaje=4");
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear estudiante</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <?php
    if ($role == $roles['administrador']) {
        include_once('../../administrador/menu.php');
    } elseif ($role == $roles['docente']) {
        include_once('../../profesores/menu.php');
    }
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Creación de Estudiantes
                        <a href="<?= ROOT ?>modulos/estudiantes/estudiantes.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="add.php" method="POST" name="forestudiantes">
                            <div id='mensaje'> </div>
                            <div class="form-group">
                                <label for="identificacion">Identificación</label>
                                <input type="number" class="form-control" id="identificacion" name="identificacion">
                            </div>

                            <div class="form-group">
                                <label for="fnacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fnacimiento" name="fnacimiento" required>
                            </div>


                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>


                            <input type="button" class="btn btn-primary" onclick="ValidarEstudiantes()" value='Crear'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>

            <script src="../../js/javascript.js"></script>
            <script src="../../js/validaciones.js"></script>
            <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>