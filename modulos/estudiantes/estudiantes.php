<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    } elseif ($role!=$roles['docente'] && $role!=$roles['administrador']){
        session_destroy();
        header("Location:  ".ROOT."index.php?mensaje=4");
    }

    $conexion = new Database;  
    $result = $conexion->DatosEstudiantes();
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver estudiantes</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <!-- <?php 
        if($role=="1"){
            include_once('../../administrador/menu.php'); 
        }else if($role=="2"){
            include_once('../../profesores/menu.php'); 
        }
    ?> -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-11 col-xl-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Listado de Estudiantes
                        <a href="<?= ROOT ?>modulos/estudiantes/addEstudiante.php" class="btn btn-primary">Crear Estudiante</a>
                    </div>
                    <div class="card-body">
                        <?php
                            $mensajes = array(
                                0=>"No se pudo realizar la acción, comunicate con el administrador",
                                1=>"Se eliminó correctamente el estudiante",
                                2=>"Se creó correctamente el estudiante",
                                3=>"Se actualizó correctamente el estudiante",
                                4=>"Se crearon correctamente las notas"
                            );

                            $mensaje_id = isset($_GET['mensaje']) ? (int)$_GET['mensaje'] : null;
                            $mensaje='';
                            
                            if ($mensaje_id != '') {
                                $mensaje = $mensajes[$mensaje_id];
                                $clase = 'success';
                                if ($mensaje_id == 0) $clase = 'danger';
                            }

                            if ($mensaje!='') echo "<div class='alert alert-$clase' role='alert'> $mensaje </div>";
                            
                        ?> 


                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Identificación</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Email</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Herramientas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                    foreach($result as $row) {
                                        echo "<tr>
                                                <td>".$row['identificacion']."</td>
                                                <td>".$row['nombres']." ".$row['apellidos']."</td>
                                                <td>".$row['fnacimiento']."</td>
                                                <td>".$row['email']."</td>
                                                <td>".$row['telefono']."</td>
                                                <td>".$row['direccion']."</td>
                                                <td>
                                                    <a href='".ROOT."modulos/notas/notas.php?id=".$row['identificacion']."' class='btn btn-success'>Notas</a>
                                                    <a href='editEstudiante.php?id=".$row['identificacion']."' class='btn btn-primary'>Modificar</a>
                                                    <a href='delete.php?id=".$row['identificacion']."' class='btn btn-danger'>Eliminar</a>
                                                </td>
                                            </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <div>

    <script src="../../js/javascript.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>