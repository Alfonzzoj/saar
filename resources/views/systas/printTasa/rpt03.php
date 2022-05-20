<?php
require_once ("../../inc/db.php");
require_once ("../../class/func.php");

	$n=$_SESSION['auth_nom'];
	
	$hora= date("h:i:s"); 
	
	$fecha=date("Y-m-d");
	
$search= ("select id,codtas,serie,femision,hemision,tiptas,status,encargado,codbarras from tatasas")or die ("Invalid query"); 
$rs=mysql_query($search,$conn);
$num_rows = mysql_num_rows($rs);

	$sqlT=("Select id,nombre From tiptas where monto ='$t'");
	$rsT=mysql_query($sqlT,$conn);
	$codT=mysql_result($rsT,0,0);	
	$nombT=mysql_result($rsT,0,1);
	
	$sqlCod=("Select codtas from tatasas where serie='$s' ORDER BY codtas DESC ");
	$rsCod=mysql_query($sqlCod,$conn);
	$cont=mysql_num_rows($rsCod);

	if ($cont>0){
		$codtas=mysql_result($rsCod,0,0)+1;
	}else{
		$codtas=1;
	}
	 
 require('fpdf/fpdf.php');

 
  //FORMATO DE LA PAGINA
    $pdf=new FPDF('P','mm','A4');
	$pdf->AddPage();
	$pdf->SetFont('arial','b',8);
    
		   
    //HEADER
    
    //LOGO GOBERNACION Y LOGO SAAR BOLIVAR
    $pdf->Image('saar.png',160,8,33);
    $pdf->Image('geb.png',10,8,33);
    
    //ENCABEZADO
    $pdf->SetY(8);    $pdf->SetX(80);
    $pdf->Cell(30,10,'GOBERNACION DEL ESTADO BOLIVAR',0,0,'C',0); 
    
    $pdf->SetY(13);    $pdf->SetX(80);
    $pdf->Cell(30,10,'AEROPUERTO INTERNACIONAL',0,0,'C',0);
    
    $pdf->SetY(18);    $pdf->SetX(80);
    $pdf->Cell(30,10,'"MANUEL CARLOS PIAR"',0,0,'C',0); 
    
    $pdf->SetFont('Arial','',10);
    $pdf->SetY(23);    $pdf->SetX(80);
    $pdf->Cell(30,10,'RIF: G-200040637',0,0,'C',0);
    
    $pdf->SetFont('Arial','B',14); 
    $pdf->SetFont('Arial','I',14);
    $pdf->SetY(32);    $pdf->SetX(80);
    $pdf->Cell(30,10,'Reporte de Tasas Aeroportuarias',0,0,'C',0);
 
 
 // POSICION DE CAMPOS
 
 $pdf->SetFont('arial','b',8);
 $pdf->SetFont('arial','U',8);
 
 $pdf->Ln(5);
 
 $pdf->SetX(0); 
 $pdf->Cell(30,30,'Tipo de Tasa',0,0,'C',0);
 
 $pdf->SetX(30); 
 $pdf->Cell(30,30,'Tasa Aeroportuaria',0,0,'C',0);
 
 $pdf->SetX(60); 
 $pdf->Cell(30,30,'Precio unitario',0,0,'C',0);
 
 $pdf->SetX(100); 
 $pdf->Cell(30,30,'Codigo de Barras',0,0,'C',0);
 
 $pdf->SetX(135); 
 $pdf->Cell(30,30,'Fecha Revision',0,0,'C',0);

 $pdf->SetX(170); 
 $pdf->Cell(30,30,'Hora Revision',0,0,'C',0);
 
 
 
 //RESULTADOS DE BASE DE DATOS
 
  $pdf->SetFont('arial','',8);
 
 for ($i=0;$i<$num_rows;$i++){ 
 
  $pdf->Ln(6+$i);
	
  $pdf->SetX(0); 
  $pdf->Cell(30,30,mysql_result($rs,$i,'tiptas'),0,0,'C',0);
	
  $pdf->SetX(30); 
  $pdf->Cell(30,30,$nombt,0,0,'C',0);
  
  $pdf->SetX(60); 
  $pdf->Cell(30,30,'BS. '.$t,0,0,'C',0);
  
  $pdf->SetX(100); 
  $pdf->Cell(30,30,mysql_result($rs,$i,'codbarras'),0,0,'C',0);
  
  $pdf->SetX(160);
  $pdf->Cell(30,30,mysql_result($rs,$i,'fver'),0,0,'C',0);
	
  $pdf->SetX(180);
 $pdf->Cell(30,30,mysql_result($rs,$i,'hver'),0,0,'C',0);
	
	
    }
	
$pdf->Output(); 
?> 
