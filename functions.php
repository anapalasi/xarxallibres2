<?php

function conexion($bd_config){
	try {
		// Estructura PDO

		$conexion = new PDO('mysql:host=localhost;dbname='. $bd_config['db_name'], $bd_config['user'], $bd_config['pass']);
		return $conexion;
	}
	catch (PDOException $e){
		return false;
	}
}
// Evita inyecciones de codigo
	function limpiarDatos($datos){
		$datos=htmlspecialchars($datos); 
		$datos=trim($datos); // Evita espacios en blanco
		$datos=filter_var($datos, 'FILTER_SANITIZE_STRING'); //Se borran los caracteres especiales
		return $datos;
	}

	function iniciarSession ($table, $conexion)
	{
		$statement = $conexion->prepare("SELECT * from $table where usuario = :usuario");
		$statement->execute([':usuario' => $_SESSION['usuario']]);
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
?>
