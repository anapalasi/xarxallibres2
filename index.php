<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// Comprobar sesion
	if (!isset($_SESSION['usuario'])){
		header('Location: login.php');
	}

	// Validar los datos por privilegio
	$conexion= conexion($bd_config);
	$usuario= iniciarSession('Profesor', $conexion);
	
	print_r($usuario['rol']);
?>
