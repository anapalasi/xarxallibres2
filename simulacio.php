<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
	  header('Location: login.php');
	}
	
	//echo $_POST['tutoria'];

	$conexion = conexion($bd_config);
	
	// Obtenemos los alumnos del nivel elegido

	if (strcmp($_POST['tutoria'],"4ESO") ==0){

		//Obtenemos las asignaciones de ciencias (tendremos que cambiar el año y el id_tutoria para actualizarlo el siguiente curso)

		// Obtenemos los que no son repetidores (mirar si estos cambian de itinerario y en ese caso poner el valor a 0)

		$sentencia = "SELECT A.nia, A.nombre, A.apellido1, A.apellido2, H.puntos, T.id_aula, A.repetidor FROM Historico H, Alumno A, Tutoria T where H.nia = A.nia and A.opcion=\"AC\" and A.id_tutoria like '21_4ESO%' and banc_llibres=1 and T.id_tutoria=A.id_tutoria and H.curso=\"2020\" and A.repetidor=0 order by H.puntos desc";

		$alumnosCiencias=executaSentenciaTotsResultats($conexion,$sentencia);

		$sentencia="SELECT H.id_lote, H.puntos,T.id_aula, L.retirat, L.repartit from Historico H, Tutoria T, Lote L, Alumno A where T.id_tutoria=H.id_tutoria and L.id_lote=H.id_lote and H.id_lote like '4ESOAC%' and H.curso=\"2020\" and A.id_lote=L.id_lote and A.repetidor=0  and L.repartit=0 order by H.puntos desc, T.id_aula asc ";
		$llibresCiencies=executaSentenciaTotsResultats($conexion,$sentencia);

		echo "Alumnos: " . count($alumnosCiencias) . " Lotes: ". count($llibresCiencies). " <br>";
		
		if (count($alumnosCiencias)> count($llibresCiencies))
		{
			echo "Hay más alumnos que lotes";
		}
		elseif (count($alumnosCiencias)<count($llibresCiencies)) {
			echo "Hay menos alumnos que lotes";
		}
		else{
			echo "Hay el mismo número de lotes que de alumnos";
		}

		assignaLotsAlumnes($alumnosCiencias, $llibresCiencies);
	}

	


	/*echo "<!DOCTYPE html>";
	echo "<html lang=\"en\">";
	echo "<head>";
 	echo "<meta charset=\"utf-8\">";
  	echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
  	echo "<meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">";
 	echo "<link rel=\"stylesheet\" href=\"css/font-awesome.min.css\">";
    echo "<link rel=\"stylesheet\" href=\"css/style.css\">";
    echo "<title>Nous grups curs 21/22 </title> ";
    echo "<head>";
	echo "<body class=\"bg-image\">";
	echo "<p align=\"center\"> <img src=\"img/xarxa_llibres-300x150.png\" alt=\"Logo Xarxa Llibres\"></p><br>";
	echo "<center><h1 class=\"texto\"> Alumnes de ";
	echo $tutoria;
	echo " en el curs 20/21 </h1></center>";
	echo "<br><br>";
	echo " <form action=\"assignacioNousGrups.php\" method=\"post\" width=\"100%\">";
	echo " <table border=\"1\" align=\"center\" bgcolor=\"white\" width=\"100%\">";
	echo "<tr><th> Nom </th> <th> Cognoms </th><th> Tutoria actual </th><th> Nova tutoria </th></tr>";

 
	foreach ($alumnos as $alumno){
		
		$nia = $alumno["nia"];
		echo  "<tr align=\"center\"><td>";

		echo "<input type=\"hidden\" name=\"nia[]\" value=\"";
		echo $nia;
		echo "\">";
	      echo  utf8_encode($alumno["nombre"]) . "</td> <td>" . utf8_encode($alumno["apellido1"]);
                echo  " " . utf8_encode($alumno["apellido2"]) ."</td><td>";
                echo  $alumno["id_tutoria"] . "</td><td>";
                echo "<select name=\"nuevaTutoria[]\">";
				echo "<option value=\"no\"> No assignada </option> ";
				foreach ($nuevasTutorias as $nuevaTutoria){
					$tut_actual=$nuevaTutoria['id_tutoria'];
					echo "<option value=\"";
					echo $tut_actual;
					echo "\">";
					echo $tut_actual;
					echo "</option>";
				}
				
		echo "</select>";
		echo   "</td></tr>";
	
        }

        echo "</table>";
 		echo "<br><br>";
 		echo "<p align=\"center\"> <button type=\"reset\" value=\"reset\"> Valors inicials </button>"; 
 		echo "<button type=\"submit\" value=\"submit\"> Guardar canvis </button>  </p> ";
 		echo "</form>";
 		echo "<center> <a href=\"";

  if ($usuario['rol'] == 'administrador')
  {
    echo "admin.php";
  }
  else
  {
    echo "usuario.php";
  }

echo "\">";
echo "<img src=\"img/casa.png\" width=\"5%\"></a></center>";
echo "<br>";
echo "<a href=\"close.php\">Cerrar Sesion</a>";
echo "</body>";
echo "</html>";*/
?>
 
 
  
  
 




 