<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

  <title> Llibres a reposar per l'alumnat </title>
</head>
<body class="bg-image">
  <p align="center"> <img src="img/xarxa_llibres-300x150.png" alt="Logo Xarxa Llibres"></p><br>
    <h1 align="center" class="texto">Llibres a reposar <?php echo $qui; ?> </h1>
    <br>
  <center>
  <table border="1" bgcolor="white" align="center">
    <tr>
      <th> Alumne </th>
      <th> Títol </th>
      <th> Identificador </th>
      <th> Volum </th>
      <th> Lot </th>
      <th> Tutoria </th>

    </tr>
    <?php
      foreach ($reposar as $llibre){
        echo "<tr>";
        echo "<td>";
        echo utf8_encode($llibre["nombre"]). " " . utf8_encode($llibre["apellido1"]). " " .utf8_encode($llibre["apellido2"]);
        echo "</td>";
        echo "<td>";
        echo utf8_encode($llibre["titulo"]);
        echo "</td>";
        echo "<td>";
        echo utf8_encode($llibre["id_ejemplar"]);
        echo "</td>";
        echo "<td>";
        echo utf8_encode($llibre["volumen_libro"]);
        echo "</td>";
        echo "<td>";
        echo utf8_encode($llibre["id_lote"]);
        echo "</td>";
        echo "<td>";
        echo utf8_encode($llibre["id_tutoria"]);

        echo "</td>";
        echo "</tr>";
      }
    ?>
  </table>
</center>
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
<center>
<img src="img/casa.png" width="5%"></a></center>
  <br>

  <a href="close.php">Cerrar Sesion</a>
</body>
</html>

