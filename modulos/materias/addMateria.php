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
    <title>Crear materia</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <?php
    if ($role == "1") {
        include_once('../../administrador/menu.php');
    } else if ($role == "2") {
        include_once('../../profesores/menu.php');
    }
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Creación de Materia
                        <a href="<?= ROOT ?>modulos/materias/materias.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="add.php" method="POST" name="formateria">
                            <div id='mensaje'> </div>
                            <div class="form-group">
                                <label for="nombre">Nombre*</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="horario">Horario*</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select name="dia" id="dia" class="form-control">
                                            <option value="1">Lunes</option>
                                            <option value="2">Martes</option>
                                            <option value="3">Miercoles</option>
                                            <option value="4">Jueves</option>
                                            <option value="5">Viernes</option>
                                            <option value="6">Sabado</option>
                                            <option value="7">Domingo</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" id="hora" name="hora" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="docente">Docente*</label>
                                <input type="text" class="form-control" id="docente" name="docente" required>
                            </div>

                            <div class="form-group">
                                <label for="docente">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" style="resize:none"
                                    cols="20" rows="4"></textarea>
                            </div>

                            <input type="button" class="btn btn-primary" onclick="ValidarMaterias()" value="Crear">
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