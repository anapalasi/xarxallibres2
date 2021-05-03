<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

  <title>Valoracio de llibres d'un grup </title>
</head>
<body class="bg-image">
  <h1 align="center" class="texto"> Valoracio de llibres del grup  </h1>
  <p align="center"> <img src="img/xarxa_llibres-300x150.png" alt="Logo Xarxa Llibres"></p><br>
  <h2 class="texto">Llistat d'alumnes de <?php echo utf8_encode($grup['descripcion']); ?> </h2>
  <br>
  <?php
	foreach ($llibres as $llibre){
		echo utf8_encode($llibre["nombre"]). " " . utf8_encode($llibre["apellido1"]). " " . utf8_encode($llibre["apellido2"]). " " . $llibre["volumen"] . " " . $llibre["puntos"];
//		echo $llibre["nombre"]. " " . $llibre["apellido1"]. " " . $llibre["apellido2"];
		echo "<br>";

	}
?>

  <a href="close.php">Cerrar Sesion</a>
</body>
</html>

