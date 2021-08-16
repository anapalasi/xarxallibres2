<?php session_start();

require 'admin/config.php';
require 'functions.php';

// comprobar session
if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
}

$conexion = conexion($bd_config);

// Primer crearem el lot (id_lote, puntos, repartit, folres, valoracioglobal, retirat)
$sentencia = "select substring(id_lote,locate('_',id_lote)+1) as numero from Lote where id_lote like '". $_POST['tipusLot']."%'";
$resultado =executaSentenciaTotsResultats($conexion,$sentencia);

$max=-1;
foreach ($resultado as $numero){
	if ($numero['numero'] >$max){
		$max=$numero['numero'];

	}
}
$numero=$max+1;
echo $numero;
// Indicarem els llibres que formen part de cada grups
//llibres = array();
 

// Obtenemos las tutorias que tienen libros

require 'views/crearLot.view.php';

