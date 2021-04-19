<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<title> Login Xarxa Llibres </title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body class="bg-image">
	<h1 align="center"> Login Xarxa Llibres </h1>
	<div class="container">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<div class="input-group">
				<i class="fa fa-user-o icons aria-hidden="false"></i>
				<input type="text" name="usuario" placeholder="Usuario" class="form-control">
			</div>
			<div class="input-group">
				<i class="fa fa-lock icons" aria-hidden="false"> </i>
				<input type="text" name="password" placeholder="Contraseña" class="form-control">
			</div>
			<button type="submit" name="submit" class="btn btn-flat-green">Entrar</button>
		</form>
	</div>
	
</body>
</html>
