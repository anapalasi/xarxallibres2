<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
	  header('Location: login.php');
	}

	$conexion = conexion($bd_config);


	// Comprobaremos el numero de tipos de observaciones que hay
	$sentencia = "select descripcion from Observacion where id_observacion !=0";
	$numeroObservaciones = executaSentenciaTotsResultats($conexion,$sentencia);

	$variable=array();
	$num_observacions = count($numeroObservaciones);

	// Obtenim totes les observacions
	$llistat_observacions = obteObservacions($conexion);
				
	// Observacions formulari
	$observacions_formulari = array();



	for($i=0;$i<count($_POST['ejemplar']);$i++){
		$sql = "update Ejemplar set puntos  = '".$_POST['estat'][$i]." ' where id_ejemplar = '".$_POST['ejemplar'][$i]."'";
		$resultat = executaSentencia($conexion,$sql);
		$indice=1;
		// Si la observacio es diferent de NULL aleshores s'afig a l'array corresponent
		if ($_POST['observacions'][$i])
			array_push($observacions_formulari, $_POST['observacions'][$i]);
	}
    
    /* Comprovem si les observacions guardades es mantenen i si no les esborrem */
	foreach ($llistat_observacions as $guardada){
		// Si no está les esborrarem
		if (!in_array($guardada, $observacions_formulari))
			echo $guardada . "s'ha esborrat";
	}

	/* Comprovem si les observacions del formulari estaven ja guardades i si no les inserirem */
	foreach ($observacions_formulari as $nova_obs){
		if (! in_array($nova_obs, $llistat_observacions))
			echo $nova_obs . "s'ha inserit";
	}

    $usuario= iniciarSession('Profesor', $conexion); // Obtenemos el rol del usuario
	
	
	
	
	require 'views/actualizaPuntuacion.view.php';
?>
