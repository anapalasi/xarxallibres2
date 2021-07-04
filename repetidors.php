<?php session_start();

        require 'admin/config.php';
        require 'functions.php';
       	require 'fpdf/fpdf.php';


        // comprobar session
        if (!isset($_SESSION['usuario'])) {
                header('Location: login.php');
        }

        $conexion = conexion($bd_config);

        $dades = alumnesRepetidors($conexion);
        
        $cabecera=array('Alumne','Tutoria');
		$anchura=array(110,40);
	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,10,'Alumnat repetidor',"C");
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','B',10);
	// Imprimimos la cabecera
	 $i=0;
 	foreach($cabecera as $col){

  	    $pdf->Cell($anchura[$i],7,utf8_decode($col),1,0,"C");
    	$i++;
	  }
 	 $pdf->Ln();
	
	foreach ($dades as $valor){
  	// Obtenemos los valores separándolos por comas
  		$i=0;
  		foreach ($valor as $dato){
  			$pdf->Cell($anchura[$i],10,utf8_decode($dato),1,0,"C");
    		$i++;
   		 }
    	$pdf->Ln();
  	}

	

	$pdf->Output();
?>


