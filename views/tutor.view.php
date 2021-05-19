<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

  <title>Recollida lots </title>
</head>
<body class="bg-image">
  <h1 align="center" class="texto"> Valoracio de llibres </h1>
  <p align="center"> <img src="img/xarxa_llibres-300x150.png" alt="Logo Xarxa Llibres"></p><br>
  <h2 class="texto"> Recollida lots grup
 <?php
	$DatosTutoria = esTutor($conexion);
	echo $DatosTutoria['descripcion'];
	?>
  </h2>
  <br>

  <table border="1" align="center" bgcolor="white">
  <tr>
    <th> Nom  </th>
    <th> Identificador del lot </th>
    <th> Tornat </th>
    <th> Folres </th>
    <th> Observacions </th>
  </tr>
<form action="actualizaRecogida.php" method="post" width="100%"> 
<?php
 
      foreach ($dades as $alumne){
	echo "<tr><td>";
	echo "<input type=\"hidden\" name=\"lote[]\" value=\"";
        echo $alumne["lote"];
	echo "\">";
        echo utf8_encode($alumne["nombre"]). " ". utf8_encode($alumne["apellido1"]). " ". utf8_encode($alumne["apellido2"]);
        echo "</td>";
        echo "<td align=\"center\">";
      
        if (strcmp($alumne["lote"],"NULL") == 0)
          echo "No té cap lot assignat";
        else
          echo $alumne["lote"];
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"checkbox\" name=\"recollit[]\" value=\"";
        echo $alumne["lote"];
        echo "\" ";
        if ($alumne["repartit"] ==0 )
		echo " checked";
       	echo ">";	
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"checkbox\" name=\"folres[]\" value=\"";
        echo $alumne["lote"];
        echo "\" ";
        if ($alumne["folres"] == 1)
		echo " checked";
        echo ">";	
        echo "</td>";
	echo "<td>";
	echo "<input type=\"text\" name=\"observacions[]\"";
  if (strcmp($alumne["lote"],"NULL") == 0)
       echo "readonly=\"readonly\"";
  else
  {
       echo "value=\"";
	     echo utf8_encode($alumne["valoracioglobal"]);
       echo "\"";
  }
	echo ">";
        echo "</td>";
        echo "</tr>";
  }
  ?>
</table>
 <p align="center"> <button type="reset" value="reset"> Valors inicials </button> <button type="submit" value="submit"> Guardar canvis </button></p>
</form>
  <a href="close.php">Cerrar Sesion</a>
</body>
</html>

