<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
	  header('Location: login.php');
	}

	$conexion = conexion($bd_config);

	// Si el archivo se ha cargado correctamente

	if (isset($_FILES)){
	

	$fileTmpPath = $_FILES['tmp_name'];

	echo var_dump($_FILES['professorat']);
	}
?>
