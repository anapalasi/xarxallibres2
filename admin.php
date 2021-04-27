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
  $admin= iniciarSession('Profesor',$conexion);
  
  if ($admin['rol'] == 'administrador'){
    require 'views/admin.view.php'
  }
  else {
    header('Location:index.php');
  }
?>
