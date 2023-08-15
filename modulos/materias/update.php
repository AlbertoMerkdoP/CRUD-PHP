<?php
session_start();
include_once("../../config/DBConect.php");
include_once("../../config/Config.php");

$id = $_GET['id'];
if (isset($_POST['nombre']))
    $nombre = $_POST['nombre'];
if (isset($_POST['dia']))
    $dia = $_POST['dia'];
if (isset($_POST['hora']))
    $hora = $_POST['hora'];
if (isset($_POST['docente']))
    $docente = $_POST['docente'];
if (isset($_POST['descripcion']))
    $descripcion = $_POST['descripcion'];

$horario = "$dias[$dia], $hora";
$conexion = new Database;
$result = $conexion->updateMateria($nombre, $horario, $docente, $descripcion, $id);

header("Location: " . ROOT . "modulos/materias/materias.php?mensaje=" . $result);

?>