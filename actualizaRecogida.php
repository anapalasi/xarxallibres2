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

	// Array que conté tots els lots
	$array_lots= array();

	for($i=0;$i<count($_POST['lote']);$i++){

		array_push($array_lots, $_POST['lote'][$i]);
		$tornat = $_POST['recollit'][$i];
		if (strcmp($tornat,"") != "")
			array_push($array_tornats,$tornat);

		$folres = $_POST['folres'][$i];
		if (strcmp($folres,"") != "")
			array_push($array_folres,$folres);

		$observacions = $_POST['observacions'][$i];

		// Si les observacions son diferents de la cadena buida
//		if (strcmp($observacions,"") != 0){
		// Actualitzarem les observacions (pot ser la cadena buida quan volem esborrar-les
		$sentencia="update Lote set valoracioglobal=\"". utf8_decode($observacions) . "\" where id_lote=\"". $_POST['lote'][$i]."\"";
		executaSentencia($conexion, $sentencia);
//		}
						
	}
	foreach ($array_lots as $lot){
		if (strcmp($lot, "NULL") !=0 ){
			if (estaEnArray($array_tornats, $lot))
				$repartit=0; // Es guarda al reves a la base de dades
			else
				$repartit=1;

			if (estaEnArray($array_folres, $lot))
				$folres=1;
			else
				$folres=0;

			$sentencia= "UPDATE Lote set repartit=". $repartit . ", folres=". $folres . " where id_lote=\"". $lot . "\"";
			executaSentencia($conexion, $sentencia); 
		}
	}

	require 'views/actualizaRecogida.view.php';
?>
