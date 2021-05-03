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
	require 'views/valoraGrup.view.php';

?>
