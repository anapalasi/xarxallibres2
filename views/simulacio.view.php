<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

  <title>Simulació assignació de llibres</title>
</head>
<body class="bg-image">
  <h1 align="center" class="texto"> Simulació assignació llibres </h1>
  <p align="center"> <img src="img/xarxa_llibres-300x150.png" alt="Logo Xarxa Llibres"></p><br>
  <h2 class="texto" align="center"> Cursos
  </h2>
  <br>
 <?php
    if (count($mostrarAssignacions) == 3)
    {
      // Es tracta de 4t d'eso
      echo "<h2 class=\"texto\"> Alumnat de Ciències </h2>";
      $ciencies = $mostrarAssignacions[0];

      echo "<center><table border=\"1\" bgcolor=\"white\" align=\"center\"> <tr><th> NIA </th><th> Nombre </th> <th> Lote </th><th>Puntos</th><th> Aula on està el lot </th></tr>";
      foreach ($ciencies as $alumnat){
        echo "<tr>";
        echo "<td>";
        echo $alumnat['nia'];
        echo "</td>";
         echo "<td>";
        echo utf8_encode($alumnat['nombre']). " ".utf8_encode($alumnat['apellido1']). " ".utf8_encode($alumnat['apellido2']) ;
        echo "</td>";
         echo "<td>";
        echo $alumnat['id_lote'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['puntos'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['id_aula'];
        echo "</td>";
        echo "</tr>";

      }
      echo "</table></center>";

      echo "<h2 class=\"texto\"> Alumnat de Lletres </h2>";
      $ciencies = $mostrarAssignacions[1];

      echo "<center><table border=\"1\" bgcolor=\"white\" align=\"center\"> <tr><th> NIA </th><th> Nombre </th> <th> Lote </th><th>Puntos</th><th> Aula on està el lot </th></tr>";
      foreach ($ciencies as $alumnat){
        echo "<tr>";
        echo "<td>";
        echo $alumnat['nia'];
        echo "</td>";
         echo "<td>";
        echo utf8_encode($alumnat['nombre']). " ".utf8_encode($alumnat['apellido1']). " ".utf8_encode($alumnat['apellido2']) ;
        echo "</td>";
         echo "<td>";
        echo $alumnat['id_lote'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['puntos'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['id_aula'];
        echo "</td>";
        echo "</tr>";

      }
      echo "</table></center>";

      echo "<h2 class=\"texto\"> Alumnat d'Aplicades </h2>";
      $ciencies = $mostrarAssignacions[2];

      echo "<center><table border=\"1\" bgcolor=\"white\" align=\"center\"> <tr><th> NIA </th><th> Nombre </th> <th> Lote </th><th>Puntos</th><th> Aula on està el lot </th></tr>";
      foreach ($ciencies as $alumnat){
        echo "<tr>";
        echo "<td>";
        echo $alumnat['nia'];
        echo "</td>";
         echo "<td>";
        echo utf8_encode($alumnat['nombre']). " ".utf8_encode($alumnat['apellido1']). " ".utf8_encode($alumnat['apellido2']) ;
        echo "</td>";
         echo "<td>";
        echo $alumnat['id_lote'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['puntos'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['id_aula'];
        echo "</td>";
        echo "</tr>";

      }
      echo "</table></center>";

      echo "<h2 class=\"texto\"> Alumnat sense lot </h2>";

       echo "<center><table border=\"1\" bgcolor=\"white\" align=\"center\"> <tr><th> NIA </th><th> Nombre </th> <th> Opcio </th><th>Puntos</th><th> Aula on està l'alumne</th></tr>";
      foreach ($alumnesSenseAssignar as $alumnat){
        echo "<tr>";
        echo "<td>";
        echo $alumnat['nia'];
        echo "</td>";
         echo "<td>";
        echo utf8_encode($alumnat['nombre']). " ".utf8_encode($alumnat['apellido1']). " ".utf8_encode($alumnat['apellido2']) ;
        echo "</td>";
         echo "<td>";
        echo $alumnat['opcion'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['puntos'];
        echo "</td>";
         echo "<td>";
        echo $alumnat['id_aula'];
        echo "</td>";
        echo "</tr>";

      }

      echo "</table></center>";

      echo "<h2 class=\"texto\"> Lots sense assignar </h2>";


    }


  ?>
 <center> <a href="<?php
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
