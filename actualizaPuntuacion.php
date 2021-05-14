<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
	  header('Location: login.php');
	}

	$conexion = conexion($bd_config);


	// Comprobaremos el numero de tipos de observaciones que hay
	$sentencia = "select descripcion from Observacion where id_observacion !=0";
	$numeroObservaciones = executaSentenciaTotsResultats($conexion,$sentencia);

	$variable=array();
	$num_observacions = count($numeroObservaciones);

	// Obtenim totes les observacions
	$llistat_observacions = obteObservacions($conexion);
	
			
	
	for($i=0;$i<count($_POST['ejemplar']);$i++){
		$sql = "update Ejemplar set puntos  = '".$_POST['estat'][$i]." ' where id_ejemplar = '".$_POST['ejemplar'][$i]."'";
		$resultat = executaSentencia($conexion,$sql);
		$indice=1;
		// Recorrem totes les possibles observacions
		var_dump($_POST['observacions'][$i]);
		foreach ($variable as $valor)
		{	
			// Comprovarem si el valor se troba en la base de dades. En cas de que siga distint de cadena
			// buida esta en la base de dades.
			$esta=observacioRegistrada($conexion, $_POST['ejemplar'][$i], $indice);
			if ($esta != ""){
				echo $valor;
				echo "Valor base de dades: " . $esta . "-> ". !empty($_POST[$valor][$i]). " " . $i . "<br>";
			}
			
			// Si estava marcat al formulari
		/*	$esta_formulari = isset($POST[$valor][$i]);
			if ($valor == $_POST[$valor][$i])
				echo "Eureka";
			echo $_POST['ejemplar'][$i]. " ". $valor. " Esta:". $esta_formulari . "<br>";	
			if (!empty($_POST[$valor][$i])){
				echo "Entra <br>"; 
				// Si está activat hem de comprobar si ja estava inserit
				if (! $esta){
					echo $valor . " " .$esta.  "No estava";
				}					

			}
			else
			{
				// Comprovem si estava activat per desactivar-ho
				if ($esta){
					echo $esta . "Cal esborrar-lo";
				}
				
			}*/
			$indice++;
		}
		
	}
    
    $usuario= iniciarSession('Profesor', $conexion); // Obtenemos el rol del usuario
	
	
	
	
	require 'views/actualizaPuntuacion.view.php';
?>
