<?php session_start();

	require 'admin/config.php';
	require 'functions.php';

	// comprobar session
	if (!isset($_SESSION['usuario'])) {
	  header('Location: login.php');
	}

	$conexion = conexion($bd_config);
	
	$sentencia="insert into Alumno (nia, nombre, apellido1, apellido2, banc_llibres, id_lote, id_tutoria) VALUES (\"";
	$sentencia = $sentencia . $_POST['nia'];
	$sentencia = $sentencia . "\", \"";
	$sentencia = $sentencia . $_POST['nombre'];
	$sentencia = $sentencia . "\", \"";
	$sentencia = $sentencia . $_POST['apellido1'];
	$sentencia = $sentencia . "\", \"";
	$sentencia = $sentencia . $_POST['apellido2'];
	$sentencia = $sentencia . "\", ";
	if (strcmp($_POST['banc'],"") == 0)
		$sentencia = $sentencia . "0";
	else
		$sentencia = $sentencia . "1";
	$sentencia = $sentencia . ", \"";
	if (strcmp($_POST['id_lote'],"") == 0)
		$sentencia = $sentencia . "NULL";
	else
		$sentencia = $sentencia . $_POST['id_lote'];
	$sentencia = $sentencia . "\", \"";
	$sentencia = $sentencia . $_POST['tutoria'];
	$sentencia = $sentencia . "\")";

	// Insertamos alumno en la base de datos
	executaSentencia($conexion, $sentencia);

	echo $_POST["nombre"]. " ". $_POST["apellido1"]. " ha sigut donat d'alta <br>";

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
	echo "<img src=\"img/casa.png\" width=\"5%\"></a></center> <br>";
  	echo "<a href=\"close.php\">Cerrar Sesion</a>";
	echo "</body>";
	echo "</html>";
?>
