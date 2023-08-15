<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $identificacion = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->EliminarEstudiante($identificacion);

    header("Location: ".ROOT."modulos/estudiantes/estudiantes.php?mensaje=".$result);

?>