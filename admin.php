<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
  		header('Location: '.RUTA.'login.php');
	}

	$conexion = conexion($bd_config);
	$admin = iniciarSession('Profesor', $conexion);

	if ($admin['rol'] == 'administrador') {
	  // traer el nombre del usuario
	  $user = iniciarSession('Profesor', $conexion);


	  require 'views/admin.view.php';
	} else {
	  header('Location: '.RUTA.'index.php');
	}

 ?>

