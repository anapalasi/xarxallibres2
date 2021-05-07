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

		echo  "<tr align=\"center\"><td>";

		echo "<input type=\"hidden\" name=\"ejemplar[]\" value=\"";
		echo $llibre["ejemplar"];
		echo "\">";
	       	echo  utf8_encode($llibre["nombre"]) . "</td> <td>" . utf8_encode($llibre["apellido1"]);
                echo  " " . utf8_encode($llibre["apellido2"]) ."</td><td>";
                echo  $llibre["ejemplar"] . "</td><td>";
		echo  $llibre["volumen"] . "</td><td>";
		echo "<select name=\"estat[]\">";
		echo "<option value=\"3\" ";
		if ($llibre["puntos"] == "3")
			echo "selected";
		echo "> MB </option>";
		echo "<option value=\"2\" ";
                if ($llibre["puntos"] == "2")
                        echo "selected";
                echo "> B </option>";
		echo "<option value=\"1\" ";
                if ($llibre["puntos"] == "1")
                        echo "selected";
                echo "> R </option>";
		echo "<option value=\"0\"";
                if ($llibre["puntos"] == "0")
                        echo "selected";
                echo "> M </option>";


		echo "</select>";
               echo   "</td></tr>";
        }

?>
 </table>
 <br><br>
 <p align="center"> <button type="reset" value="reset"> Valores iniciales </button> <button type="submit" value="submit"> Guardar cambios </button></p> 
 </form>
  <a href="close.php">Cerrar Sesion</a>
</body>
</html>

