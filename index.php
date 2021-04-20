<?php

	require 'admin/config.php';
	require 'functions.php';

	$errores='';

	if ($_SERVER['REQUEST_METHOD']=='POST'){
		$usuario=$_POST['usuario'];
		$password= $_POST['password'];
		$password = hash('sha512',$password);

		$conexion=conexion($bd_config);

		$statement=$conexion->prepare('select * from Profesor where usuario= :usuario and password= :password');
		$statement->execute([
			':usuario' => $usuario,
			':password' => $password
		]);

		$resultado = $statement->fetch();

		// Minuto 6
	}
	require 'views/login.view.php';


?>
