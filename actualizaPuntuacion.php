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

	for ($i=1;$i<=$num_observacions;$i++){
			$valor = "observacions" . strval($i);
			array_push($variable, "observacions". strval($i));
	}

	

	for($i=0;$i<count($_POST['ejemplar']);$i++){
		$sql = "update Ejemplar set puntos  = '".$_POST['estat'][$i]." ' where id_ejemplar = '".$_POST['ejemplar'][$i]."'";
		$resultat = executaSentencia($conexion,$sql);
		$indice=1;
		foreach ($variable as $valor)
		{
			$esta=observacioRegistrada($conexion, $_POST['ejemplar'][$i], $indice);
			echo $esta;
			if (!empty($_POST[$valor][$i])){
				// Si está activat hem de comprobar si ja estava inserit
				echo "";

			}
			else
			{
				// Comprovem si estava activat per desactivar-ho
				echo "";
			}
			$indice++;
		}
		
	}
    
    $usuario= iniciarSession('Profesor', $conexion); // Obtenemos el rol del usuario
	
	
	
	
	require 'views/actualizaPuntuacion.view.php';
?>
