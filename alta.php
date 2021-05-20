<?php
	$sentencia="insert into Alumno (nia, nombre, apellido1, apellido2, banc_llibres, id_lote, id_tutoria) VALUES (";
	$sentencia = $sentencia . $_POST['nia'];
	echo $sentencia;

?>
