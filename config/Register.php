<?php

include_once("DBConect.php");

if (isset($_POST['emailregis']))
   $username = $_POST['emailregis'];
if (isset($_POST['password']))
   $password = $_POST['password'];
if (isset($_POST['nombres']))
   $nombres = $_POST['nombres'];
if (isset($_POST['apellidos']))
   $apellidos = $_POST['apellidos'];
if (isset($_POST['confirmPassword']))
   $confirmPassword = $_POST['confirmPassword'];
if (isset($_POST['identificacion']))
   $identificacion = $_POST['identificacion'];

$conexion = new Database;
$result_consulta = $conexion->ValidacionCorreo($username);
$cantidad = $result_consulta->rowCount();

if ($cantidad > 0) {
   header('Location: ../index.php?mensaje=3');
} elseif ($password == $confirmPassword) {
   $result = $conexion->Registrar($username, $password, $nombres, $apellidos, $identificacion);

   header('Location: ../index.php?mensaje=' . $result);
}


?>