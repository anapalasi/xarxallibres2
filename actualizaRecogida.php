<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
	  header('Location: login.php');
	}

	$conexion = conexion($bd_config);

	// Array on es guardaran els lots que s'han tornat
	$array_tornats=array();

	// Array folres
	$array_folres=array();

	for($i=0;$i<count($_POST['lote']);$i++){

		$tornat = $_POST['recollit'][$i];
		if (strcmp($tornat,"") != "")
			array_push($array_tornats,$tornat);

		$folres = $_POST['folres'][$i];
		if (strcmp($folres,"") != "")
			array_push($array_folres,$folres);

		$observacions = $_POST['observacions'][$i];

		// Si les observacions son diferents de la cadena buida
		if (strcmp($observacions,"") != 0){
			// Actualitzarem les observacions
			$sentencia="update Lote set valoracioglobal=\"". $observacions . "\" where id_lote=\"". $_POST['lote'][$i]."\"";
			executaSentencia($conexion, $sentencia);
		}
		

				
	}
	/*	$sql = "update Ejemplar set puntos  = '".$_POST['estat'][$i]." ' where id_ejemplar = '".$_POST['ejemplar'][$i]."'";
		array_push($exemplars,$_POST['ejemplar'][$i]);
		$resultat = executaSentencia($conexion,$sql);
		$indice=1;
		// Si la observacio es diferent de NULL aleshores s'afig a l'array corresponent
		if ($_POST['observacions'][$i])
			array_push($observacions_formulari, $_POST['observacions'][$i]);
	}
    	/* Comprovem si les observacions guardades es mantenen i si no les esborrem */
	/*foreach ($llistat_observacions as $guardada){
		// Dividim amb el caracter separador. parts[0] seria l'exemplar i part[1] l'observacio
		$parts = explode("-",$guardada); 

		// Comprovem que l'observacio pertany a aquest curs
		if (estaEnArray($exemplars,$parts[0]))
		{
			// Si ja no estan al formulari s'han d'esborrar
			if (! in_array($guardada, $observacions_formulari)){
				$sentencia = "DELETE FROM ObservacionEjemplar WHERE id_ejemplar=\"" . $parts[0]. "\" and id_observacion=\"". $parts[1]."\"";
				executaSentencia($conexion, $sentencia);	
			}
		}
			
		
	}

	/* Comprovem si les observacions del formulari estaven ja guardades i si no les inserirem */
/*	foreach ($observacions_formulari as $nova_obs){
		//Dividim amb el caracter separador
		$parts = explode("-",$nova_obs);
		
		// Si no es troba en els llistats guardats hem d'inserir-la
		if (! in_array($nova_obs, $llistat_observacions)){
			$sentencia = "INSERT INTO ObservacionEjemplar (id_ejemplar, id_observacion) VALUES (\"". $parts[0]. "\",". $parts[1]. ")"; 
			executaSentencia($conexion, $sentencia);	
		}
	}
	 */
//    $usuario= iniciarSession('Profesor', $conexion); // Obtenemos el rol del usuario
	
	
	
	
	require 'views/actualizaRecogida.view.php';
?>
