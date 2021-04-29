<?php session_start();

        require 'admin/config.php';
        require 'functions.php';

        // comprobar session
        if (!isset($_SESSION['usuario'])) {
                header('Location: login.php');
        }

        $conexion = conexion($bd_config);
	$grupos = GrupoLibro($conexion, $_SESSION['usuario']);
	foreach ($grupos as $val) {
		echo $val['descripcion'];
		echo "<br>";	
	}
//	require 'views/valorar.view.php';

?>
