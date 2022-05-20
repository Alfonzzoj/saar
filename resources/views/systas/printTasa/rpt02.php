<?php
require_once ("../../inc/db.php");
require_once ("../../class/func.php");

$search= ("select id,codtas,serie,femision,hemision,tiptas,status,encargado,codbarras from tatasas")or die ("Invalid query"); 
$rs=mysql_query($search,$conn);
$num_rows = mysql_num_rows($rs);
 
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
 $pdf->Ln(5);
 
 $pdf->SetX(0);
 $pdf->Cell(30,30,'Serie',0,0,'C',0);
 
 $pdf->SetX(30); 
 $pdf->Cell(30,30,'Tipo de Tasa',0,0,'C',0);
 
 $pdf->SetX(60); 
 $pdf->Cell(30,30,'Fecha',0,0,'C',0);
 
 $pdf->SetX(90); 
 $pdf->Cell(30,30,'Hora',0,0,'C',0);
 
 $pdf->SetX(120); 
 $pdf->Cell(30,30,'Encargado',0,0,'C',0);
 
 $pdf->SetX(150); 
 $pdf->Cell(30,30,'Codigo',0,0,'C',0);
 

 //RESULTADOS DE BASE DE DATOS
 
 for ($i=0;$i<$num_rows;$i++){ 
 
  $pdf->Ln(6+$i);
	
  $pdf->SetX(0);
  $pdf->Cell(30,30,mysql_result($rs,$i,'serie'),0,0,'C',0);
  
  $pdf->SetX(30); 
  $pdf->Cell(30,30,mysql_result($rs,$i,'tiptas'),0,0,'C',0);
  
  $pdf->SetX(60); 
  $pdf->Cell(30,30,mysql_result($rs,$i,'femision'),0,0,'C',0);
  
  $pdf->SetX(90); 
  $pdf->Cell(30,30,mysql_result($rs,$i,'hemision'),0,0,'C',0);
  
  $pdf->SetX(120); 
  $pdf->Cell(30,30,mysql_result($rs,$i,'encargado'),0,0,'C',0);
  
  $pdf->SetX(150); 
  $pdf->Cell(30,30,mysql_result($rs,$i,'codbarras'),0,0,'C',0);
    }
$pdf->Output(); 
?> 
