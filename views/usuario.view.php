
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="css/font-awesome.min.css">
   <link rel="stylesheet" href="css/style.css">

  <title>Bienvenido Usuario</title>
</head>
<body class="bg-image">
  <h1>Hola <?php echo utf8_encode($user['nombre']) ." ". utf8_encode($user['apellido1']) ; ?></h1>
   <h2> Pots fer aquestes operacions </h2>
   <ul> 
	<li> <a href="valorar.php"> Valorar llibres</a> </li>
	<?php
		if ($tutor != "") 
			 echo "<li><a href=\"tutor.php\">" .  $tutor. "</a></li>";

	?>
   </ul>
   <a href="close.php">Cerrar Sesion</a>
</body>
</html>
