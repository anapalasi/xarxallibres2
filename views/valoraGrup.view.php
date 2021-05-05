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
  <form action="actualizaPuntuacion.php" method="post">
  <table border="1" align="center" bgcolor="white" width="70%">

  <tr><th> Nom </th> <th> Cognoms </th><th> Exemplar </th><th> Volum </th> <th> Estat </th></tr>
  <?php
	foreach ($llibres as $llibre){
		echo "<tr><td>";
		echo utf8_encode($llibre["nombre"]);
	        echo "</td> <td>";
		echo utf8_encode($llibre["apellido1"]). " " . utf8_encode($llibre["apellido2"]);
	        echo "</td><td>";
		echo $llibre["ejemplar"];
	        echo "</td><td>";
		echo $llibre["volumen"];
		echo "</td><td>";
		if ($llibre["puntos"] == 3)
			echo "MB";
		else {
			if ($llibre["puntos"]==2){
				echo "B";
			}
			else{
				if ($llibre["puntos"] == 1){
					echo "R";
				}
			}
		}
		echo "</td></tr>";

	}
?>
 </table>
 </form>
  <a href="close.php">Cerrar Sesion</a>
</body>
</html>

