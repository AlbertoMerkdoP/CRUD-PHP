<?php
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    session_start();
    $role = $_SESSION['sess_userrole'];

    if (!isset($_SESSION['sess_username'])) {
        header("Location: " . ROOT . "index.php?mensaje=2");
    } elseif ($role != $roles['docente'] && $role != $roles['administrador']) {
        session_destroy();
        header("Location: " . ROOT . "index.php?mensaje=4");
    }

    $id = $_GET['id'];

    $conexion = new Database;
    $result = $conexion->editMateria($id);

    $mat_id = $mat_nombre = $mat_horario = $mat_docente = $mat_descripcion = "";
    foreach ($result->fetchAll(PDO::FETCH_OBJ) as $r) {
        $mat_id = $r->id;
        $mat_nombre = $r->nombre;
        $mat_horario = $r->horario;
        $mat_dia = explode(',', $mat_horario)[0];
        $mat_dia = array_search($mat_dia, $dias);
        $mat_hora = explode(',', $mat_horario)[1];
        $mat_docente = $r->docente;
        $mat_descripcion = $r->descripcion;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar materia</title>
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
                        Modificar Materias
                        <a href="<?= ROOT ?>modulos/materias/materias.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="update.php?id=<?= $id ?>" method="POST" name="forrol">
                            <div class="form-group">
                                <label for="nombre">Nombre*</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="<?= $mat_nombre ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="horario">Horario*</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select name="dia" id="dia" class="form-control" value="<?= $mat_dia ?>">
                                            <?php
                                            foreach ($dias as $dia => $opcion) {
                                                echo '<option value="' . $dia . '"';
                                                if ($dia == $mat_dia) {
                                                    echo ' selected="selected"';
                                                }
                                                echo '>' . $opcion . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" id="hora" name="hora" value=<?= $mat_hora ?> required></input>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="docente">Docente*</label>
                                <input type="text" class="form-control" id="docente" name="docente"
                                    value="<?= $mat_docente ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" style="resize:none"
                                    cols="20" rows="4"><?= $mat_descripcion ?></textarea>
                            </div>


                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>

            <script src="../../js/javascript.js"></script>
            <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>