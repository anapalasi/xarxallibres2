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
		$statement = $conexion->prepare("SELECT * from $table where dni = :usuario");
		$statement->execute([':usuario' => $_SESSION['usuario']]);
		return $statement->fetch(PDO::FETCH_ASSOC);
	}

	/* Funcion que comprueba si el usuario es tutor de un grupo*/
	function esTutor($conexion){
		$statement = $conexion->prepare("SELECT * FROM Tutoria  where dni_tutor = :dni");
		$statement->execute([ ':dni' => $_SESSION['usuario']]);
	 	return	$statement->fetch(PDO::FETCH_ASSOC);
	}

	/* Funcion que extrae datos de los grupos donde el profesor tiene libros a valorar */
	function GrupoLibro($conexion, $dni){
		$sentencia= "SELECT distinct G.id_grupo, descripcion from Grupo G, GrupoProfesor GP, Libro L where G.id_grupo = GP.id_grupo and G.id_asignatura = L.id_asignatura and GP.dni= :dni";
		$statement = $conexion->prepare($sentencia);
		$statement->execute([ ':dni' => $dni ]);
	 	return	$statement->fetchAll(PDO::FETCH_ASSOC);
	}

	/* Funcio que obte les dades d'un grup*/
	function dadesGrup($conexion, $grup){
		$sentencia = "SELECT * from Grupo where id_grupo = :grupo";
		$statement = $conexion->prepare($sentencia);
		$statement->execute([ ':grupo' => $grup]);
		return $statement->fetch(PDO::FETCH_ASSOC);
	}

	/* Funcio que mostra els llibres d'un grup */
	function mostraLlibres($conexion, $grup){
		$sentencia="SELECT distinct A.nombre as nombre, A.apellido1 as apellido1, A.apellido2 as apellido2, E.id_ejemplar as ejemplar, E.volumen_libro as volumen, E.puntos as puntos FROM Grupo G, AlumnoGrupo AG, Alumno A, Ejemplar E, Libro L  WHERE G.id_grupo= :grupo and AG.nia=A.nia and AG.id_grupo = G.id_grupo and E.id_lote = A.id_lote and E.isbn_libro = L.isbn and L.id_asignatura= G.id_asignatura order by A.apellido1, A.apellido2, A.nombre, E.volumen_libro";
		$statement = $conexion->prepare($sentencia);
		$statement->execute([ ':grupo' => $grup]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	/* Funcio que executa una sentencia  en la base de dades sense parametres */
	function executaSentencia($conexion, $sentencia){
		$statement = $conexion->prepare($sentencia);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
?>
