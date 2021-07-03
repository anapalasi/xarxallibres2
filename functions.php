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


	  /* Funcio que mostra els llibres no valorats d'un grup al tutor */
        	function mostraLlibresNoValorats($conexion, $tutoria){
                $sentencia="SELECT distinct A.nombre as nombre, A.apellido1 as apellido1, A.apellido2 as apellido2, L.titulo as titulo, E.id_ejemplar as ejemplar, E.volumen_libro as volumen, E.puntos as puntos FROM Alumno A, Ejemplar E, Libro L  WHERE E.id_lote = A.id_lote and E.isbn_libro = L.isbn and E.volumen_libro=L.volumen and E.puntos=-1 and A.id_tutoria= :tutoria order by A.apellido1, A.apellido2, A.nombre, E.volumen_libro";
                $statement = $conexion->prepare($sentencia);
                $statement->execute([ ':tutoria' => $tutoria]);
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

	/* Funcio que executa una sentencia  en la base de dades sense parametres */
	function executaSentencia($conexion, $sentencia){
		$statement = $conexion->prepare($sentencia);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}

	function executaSentenciaTotsResultats($conexion, $sentencia){
		$statement = $conexion->prepare($sentencia);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	/* Funcio que obte les observacions d'un exemplar */
	function observacionsExemplar($conexion, $exemplar){
		$sentencia ="select id_observacion from ObservacionEjemplar where id_ejemplar = :exemplar order by id_observacion";	
        $statement = $conexion->prepare($sentencia);
        $statement->execute([ ':exemplar' => $exemplar]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);

	}

	/* Funcio que indica si una observacio d'un exemplar es troba registrada o no */
	function observacioRegistrada($conexion, $exemplar, $observacio)
	{
		$sentencia= "select * from ObservacionEjemplar where id_observacion =\"" . $observacio. "\" and id_ejemplar = \"" . $exemplar. "\"";
		$resultat = executaSentencia($conexion, $sentencia); 
		return $resultat["id_observacion"];
	}

	/* Funcio que obté totes les observacions */
	function obteObservacions ($conexion)
	{
		$sentencia = "select * from ObservacionEjemplar";
		$resultat = executaSentenciaTotsResultats($conexion,$sentencia);
		$array_observacions = array();
		foreach ($resultat as $observacio)
		{
			$cadena = $observacio["id_ejemplar"]. "-". $observacio["id_observacion"];
			array_push($array_observacions, $cadena);
		}
		
		return $array_observacions;
	}

	/*Funcio que indica si una cadena es troba en un array */
	function estaEnArray($lista, $cadena){
		$encontrado = False;

		foreach ($lista as $elemento){
			if (strcmp($elemento, $cadena) == 0){
				$encontrado = True;
				break;
			}
		}
		return $encontrado;
	}

	/* Funció que obte les dades que es mostren en recollida de lots */
	function dadesRecollidaLots($conexion, $tutoria)
	{
		$sentencia = "select A.nombre, A. apellido1, A.apellido2, A.nia as nia, L.repartit, L.folres, L.valoracioglobal, A.id_lote as lote, A.repetidor as repetidor from Alumno A, Lote L where A.id_lote = L.id_lote and A.banc_llibres!=0 and A.id_tutoria=\"" . $tutoria . "\" order by A.apellido1, A.apellido2, A.nombre";
		$resultats =executaSentenciaTotsResultats($conexion, $sentencia);
		return $resultats;
	}

	/* Funcio que mostra els llibres d'un lot */
	function mostraLlibresLot($conexion, $id_lote)
	{
		$sentencia = "select distinct E.id_ejemplar as id_ejemplar, A.nombre as nombre, E.puntos as puntos, E.volumen_libro as volumen from Ejemplar E, Libro L, Asignatura A  where E.isbn_libro = L.isbn and L.id_asignatura = A.id_asignatura and id_lote=\"" . $id_lote . "\" order by E.id_ejemplar, E.volumen_libro";
		$llibres = executaSentenciaTotsResultats($conexion, $sentencia);
		return $llibres;
	}

	/* Funcio que mostra tots els llibres d'un alumne */
/*	function mostraLlibresAlumne ($conexion, $nia){
		$sentencia = "select E.id_ejemplar, E.puntos, E.fecha_mod, E.isbn_libro, E.volumen_libro, E.id_lote from Ejemplar E, Alumno A where E.id_lote = A.id_lote and A.nia =\"". $nia . "\"";
		$llibres = executaSentenciaTotsResultats($conexion, $sentencia);
                return $llibres;
}*/
	function alumnesNoXarxaTutoria($conexion, $grupo){
		$sentencia = "select nombre as nom, apellido1 as ape1, apellido2 as ape2 from Alumno A, AlumnoGrupo AG where A.nia=AG.nia and A.banc_llibres=\"0\" and AG.id_grupo=\"". $grupo."\"";

		$noxarxa=executaSentenciaTotsResultats($conexion, $sentencia);
		return $noxarxa;
	}

	/* Funcion que devuelve el nombre de los alumnos que aun tienen libros para valorar en una tutoria */
	function alumnosLibrosNoValorados($conexion, $tutoria){
		$sentencia="SELECT distinct nombre, apellido1, apellido2 from Alumno A, Ejemplar E where A.id_lote=E.id_lote and E.puntos=-1 and id_tutoria=\"". $tutoria . "\"";
		$alumnos=executaSentenciaTotsResultats($conexion, $sentencia);
		return $alumnos;
	}
	/* Funcio que torna els llibres a reposar per l'alumnat  */
	function reposarAlumnat($conexion){
		$sentencia="select distinct A.nombre, A.apellido1, A.apellido2, L.titulo, E.id_ejemplar, E.volumen_libro, A.id_tutoria, E.id_lote from Ejemplar E, ObservacionEjemplar O, Libro L, Alumno A where E.id_ejemplar = O.id_ejemplar and O.id_observacion=9 and E.isbn_libro=L.isbn and E.id_lote=A.id_lote order by A.id_tutoria, A.apellido1";
		$reposar=executaSentenciaTotsResultats($conexion, $sentencia);
		return $reposar;
	}

	/* Funcio que torna els llibres a reposar pel centre  */
	function reposarCentre($conexion){
		$sentencia="select distinct A.nombre, A.apellido1, A.apellido2, L.titulo, E.id_ejemplar, E.volumen_libro, A.id_tutoria, E.id_lote from Ejemplar E, ObservacionEjemplar O, Libro L, Alumno A where E.id_ejemplar = O.id_ejemplar and O.id_observacion=8 and E.isbn_libro=L.isbn and E.id_lote=A.id_lote order by A.id_tutoria, A.apellido1";
		$reposar=executaSentenciaTotsResultats($conexion, $sentencia);
		return $reposar;
	}

	/* Ordena els llibres d'una tutoria per puntuacio */
	function ordenaLlibresTutoria($conexion, $tutoria){
		$sentencia="SELECT E.id_lote, A.nombre, A.apellido1, A.apellido2, sum(E.puntos) as puntos FROM `Ejemplar` E, Alumno A where A.id_lote = E.id_lote and A.id_tutoria =\"". $tutoria . "\" group by E.id_lote, A.apellido1, A.apellido2, A.nombre order by puntos desc, A.apellido1,A.apellido2, A.nombre";
		$resultat= executaSentenciaTotsResultats($conexion, $sentencia);
		return $resultat;
	}
	
	function LotsPerTornar($conexion){
		$sentencia="SELECT concat(A.nombre,' ', A.apellido1,' ', A.apellido2), A.id_lote as lote, A.id_tutoria FROM Lote L, Alumno A WHERE repartit=1 and L.id_lote = A.id_lote and id_tutoria like '%ESO%' and A.id_lote != \"NULL\" and A.repetidor != 1 order by A.id_tutoria, A.apellido1, A.apellido2";
		$resultat=executaSentenciaTotsResultats($conexion,$sentencia);
		return $resultat;
	}

	/* Obtenir les valoracions globals dels lots no buides */
	function valoracioLots($conexion){
		$sentencia="SELECT A.nombre, A.apellido1, A. apellido2, A.id_lote as lote, L.valoracioglobal, A.id_tutoria FROM Lote L, Alumno A where L.valoracioglobal !=\"\"  and A.id_lote = L.id_lote ORDER BY A.id_tutoria, A.apellido1, A.apellido2, A. nombre";
		$resultat=executaSentenciaTotsResultats($conexion, $sentencia);
		return $sentencia;
	}
?>
