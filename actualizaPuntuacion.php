<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
	  header('Location: login.php');
	}

	$conexion = conexion($bd_config);

	for($i=0;$i<count($_POST['ejemplar']);$i++){
		$sql = "update Ejemplar set puntos  = '".$_POST['estat'][$i]." ' where id_ejemplar = '".$_POST['ejemplar'][$i]."'";
		$resultat = executaSentencia($conexion,$sql);
	}
        $usuario= iniciarSession('Profesor', $conexion); // Obtenemos el rol del usuario
	
	// Comprobaremos el numero de tipos de observaciones que hay
	$sentencia = "select descripcion from Observacion where id_observacion !=0";
	$numeroObservaciones = executaSentenciaTotsResultats($conexion,$sentencia);
	
	for ($i=1;$i<=count($numeroObservaciones);$i++){
		$variable = "observacions".$i;
	}	
	
	require 'views/actualizaPuntuacion.view.php';
?>
