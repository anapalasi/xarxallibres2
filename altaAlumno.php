<?php session_start();

require 'admin/config.php';
require 'functions.php';

// comprobar session
if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
}

$conexion = conexion($bd_config);
$sentencia="SELECT id_tutoria, descripcion from Tutoria where id_curso like '%ESO%' or id_curso like '%CFB%'";

// Obtenemos las tutorias que tienen libros
$tutorias = executaSentenciaTotsResultats($conexion, $sentencia);

require 'views/altaAlumno.view.php';

