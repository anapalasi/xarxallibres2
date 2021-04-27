<?php
  // Abrimos la sesion
  session_start();
  
  require 'admin/config.php'
  require 'functions.php'
  
  // Comprobamos la sesión
  if (!isset($_SESSION['usuario'])){
    header('Location:login.php');
  }
  
  $conexion = conexion($bd_config);
  $user= iniciarSession('Profesor',$conexion);
  
  if ($user == 'usuari'){
    require 'views/usuario.view.php'
  }
  else {
    header('Location:index.php');
  }
?>
