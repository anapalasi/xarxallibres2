<?php session_start();

	require 'admin/config.php';
	require 'functions.php';
	require 'fpdf/fpdf.php';

        // comprobar session
        if (!isset($_SESSION['usuario'])) {
                header('Location: login.php');
        }

	$conexion = conexion($bd_config);

	$cabecera=array('Alumne','Lot','Valoracio', 'Tutoria');
	$anchura=array(80,30,20,30);
	$valores=LotsPerTornar($conexion);

	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	// Imprimimos el título
	$pdf->Cell(0,10,utf8_decode($_POST["titulo"]),"C");
	$pdf->Ln();
	$pdf->Ln();
?>
