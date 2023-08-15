<?php

	include_once("DBConect.php");
	include_once('Config.php');
	session_start();

	$username = $password = "";

	if (isset($_POST['email']))
		$username = $_POST['email'];
	if (isset($_POST['password']))
		$password = $_POST['password'];

	$conexion = new Database;
	$result = $conexion->DatosAutenticacion($username, $password);
	$cantidad = $result->rowCount();

	if ($cantidad == 0) {
		header('Location: ../index.php?mensaje=1');
	} else {
		$row = $result->fetch(PDO::FETCH_ASSOC);

		session_regenerate_id();
		$_SESSION['sess_user_id'] = $row['id'];
		$_SESSION['sess_usernom'] = $row['nombres'];
		$_SESSION['sess_userapel'] = $row['apellidos'];
		$_SESSION['sess_identificacion'] = $row['identificacion'];
		$_SESSION['sess_username'] = $row['username'];
		$_SESSION['sess_userrole'] = $row['role'];
		session_write_close();

		if ($_SESSION['sess_userrole'] == $roles['administrador']) {
			header('Location: ../administrador/home.php');
		} elseif ($_SESSION['sess_userrole'] == $roles['docente']) {
			header('Location: ../profesores/home.php');
		} else {
			header('Location: ../estudiantes/home.php');
		}
	}


?>