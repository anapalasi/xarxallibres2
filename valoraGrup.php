<?php session_start();

        require 'admin/config.php';
        require 'functions.php';

        // comprobar session
        if (!isset($_SESSION['usuario'])) {
                header('Location: login.php');
        }

	$conexion = conexion($bd_config);
	$id_grup= $_GET["grup"];
	$grup = dadesGrup($conexion,$id_grup);
	$llibres=mostraLlibres($conexion, $id_grup);
	// Possibles valors d'observacions dels llibres
	$sentencia = "select * from Observacion where id_observacion != 0";
	$observacions = executaSentenciaTotsResultats($conexion, $sentencia);
	// Creem una llista d'exemplars
	$llista_exemplars=array();
	foreach ($llibres as $llibre){
		array_push($llista_exemplars,$llibre["ejemplar"]);
	}

	// Obtindrem les observacions de cada exemplar
	$observacionsExemplars = array();
	foreach ($llista_exemplars as $exemplar){
		$obs=array();
		$llista = observacionsExemplar($conexion, $exemplar);
		// Comprovem que la llista no estiga buida		
	}
	require 'views/valoraGrup.view.php';

?>
