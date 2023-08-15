<?php
session_start();
include_once("../../config/DBConect.php");
include_once("../../config/Config.php");

$identificacion = $_GET['id'];
if (isset($_POST['nombres']))
    $nombres = $_POST['nombres'];
if (isset($_POST['apellidos']))
    $apellidos = $_POST['apellidos'];
if (isset($_POST['fnacimiento']))
    $fnacimiento = $_POST['fnacimiento'];
if (isset($_POST['email']))
    $email = $_POST['email'];
if (isset($_POST['telefono']))
    $telefono = $_POST['telefono'];
if (isset($_POST['direccion']))
    $direccion = $_POST['direccion'];

$conexion = new Database;
$result = $conexion->updateEstudiante($nombres, $apellidos, $email, $telefono, $fnacimiento, $direccion, $identificacion);

header("Location: " . ROOT . "modulos/estudiantes/estudiantes.php?mensaje=" . $result);

?>