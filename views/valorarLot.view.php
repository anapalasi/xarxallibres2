<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

  <title>Valoracio de llibres </title>
</head>
<body class="bg-image">
  <h1 align="center" class="texto"> Valoracio dels llibres del lot 
<?php  
echo $_POST['id_lote'];
?>
</h1>
  <p align="center"> <img src="img/xarxa_llibres-300x150.png" alt="Logo Xarxa Llibres"></p><br>
  <h2 class="texto"> Llibres del lot </h2>
  <?php
	if (empty($llibres)){

		echo "<br><p> No hi ha llibres assignats a eixe lot </p><br><br>";
	}
	else {
		// Mostrem els llibres del lot
		echo "<form action=\"actualizaPuntuacion.php\" method=\"post\" width=\"100%\">";
		echo "<table border=\"1\" align=\"center\" bgcolor=\"white\" width=\"100%\">";
		echo " <tr><th> Identificador de l'exemplar </th> <th>Assignatura  </th><th> Volum </th><th>Estat  </th> <th> Observacions </th></tr>";
		foreach ($llibres as $llibre){
			echo "<tr>";
			echo "<td>";
			echo $llibre['id_ejemplar'];
			echo "</td>";
			echo "<td>";
                        echo utf8_encode($llibre['nombre']);
                        echo "</td>";
			echo "<td align=\"center\">";
                        echo $llibre['volumen'];
                        echo "</td>";
			echo "<td align=\"center\">";
                        echo $llibre['puntos'];
                        echo "</td>";
			echo "<td>";
			// Faltan las observaciones
                        echo "</td>";

			echo "</tr>";
		}
		echo " </table>";
		echo "</form>";


	}	
?>
<br><br>
<a href="<?php
  if ($usuario['rol'] == 'administrador')
  {
    echo "admin.php";
  }
  else
  {
    echo "usuario.php";
  }
?>
">

<img src="img/casa.png" width="5%"></a></center>
  <br>

  <a href="close.php">Cerrar Sesion</a>
</body>
</html>

