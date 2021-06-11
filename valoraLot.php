<?php session_start();

        require 'admin/config.php';
        require 'functions.php';

        // comprobar session
        if (!isset($_SESSION['usuario'])) {
                header('Location: login.php');
        }

	$conexion = conexion($bd_config);
	if (strcmp(trim($_POST['id_lote']),"") != 0){
		$llibres = mostraLlibresLot($conexion, $_POST['id_lote']);
		echo "Ha introducido lote " . $_POST['id_lote'];
	}
	else {
		if (strcmp(trim($_POST['nia']),"") !=0){
//			$llibres= mostraLlibresAlumne($conexion, $_POST['nia']);
			echo "Ha introducido nia";
		}
	}
	if ((strcmp(trim($_POST['id_lote']),"") == 0) && (strcmp(trim($_POST['nia']),"") == 0))
		echo "No ha introducido datos para identificar el lote";
	
	require 'views/valorarLot.view.php';

?>
