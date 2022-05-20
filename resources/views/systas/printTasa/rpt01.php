<?php session_start();

require_once ("../../inc/db.php");
require_once ("../../class/func.php");

$s              =$_REQUEST['s'];
$t              =$_REQUEST['tTasa'];
$c              =$_REQUEST['cTasa'];

$n              =$_SESSION['auth_nom'];

$hora           = date("h:i:s"); 

$fecha          =date("Y-m-d");
/*
*Codigo de Tasa 
*/
$sqlT           =("Select id,nombre From tiptas where monto ='$t'");
$rsT            =mysql_query($sqlT,$conn);
$codT           =mysql_result($rsT,0,0);	
$nombT          =mysql_result($rsT,0,1);	

$sqlCod         =("Select codtas from tatasas where serie='$s' ORDER BY codtas DESC ");


$rsCod          =mysql_query($sqlCod,$conn);

$cont           =mysql_num_rows($rsCod);

if ($cont>0){
	$codtas         =mysql_result($rsCod,0,0)+1;
}else{
	$codtas         =1;
}

function codigoB ($s, $codT, $j, $conn, $codNew){

	$tCod           =strlen($codNew);

	$tCod           =8-$tCod;

	$cero           ="0";

	for ($m         =1;$m<$tCod;$m++){
		$cero           =$cero."0";
	}

	$tCod           =$cero.$codNew;

	$codBarra       =$s.$codT."-".date("d").date("m").date("Y")."-".$tCod;

	return $codBarra;
}

/*
*Codigo de Barra
*/

// Define variable to prevent hacking
define('IN_CB',true);

// Including all required classes
require('barcode/class/index.php');
require('barcode/class/FColor.php');
require('barcode/class/BarCode.php');
require('barcode/class/FDrawing.php');

// including the barcode technology
include('barcode/class/code128.barcode.php');

// Creating some Color (arguments are R, G, B)
$color_black    = new FColor(0,0,0);
$color_white    = new FColor(255,255,255);//color de fondo de la imagen 255 = blanco
/* Here is the list of the arguments:
1 - Ancho
2 - Color de las barras
3 - Color of spaces
4 - Resolucion
5 - Text
6 - Text Font (0-5) si se quiere mostrar el numero al cual corresponde el codigo, para ocultarlo se deja con 0 */
// Ojo! si la imagen ya esta en la carpeta img la sustituye!
$ind            =1;
//while ($row   = mysql_fetch_row($resul)){

$codNew         =$codtas;
for ($j         =0;$j<$c;$j++){

	$codigoDeBarra  =codigoB($s, $codT, $j, $conn, $codNew);

	$code_generated = new code128(45,$color_black,$color_white,1,$codigoDeBarra,5);

	mysql_query("INSERT INTO tatasas (id, codtas,serie,femision,hemision,tiptas,status,encargado,codbarras) VALUE ('','$codNew','$s','$fecha','$hora','$codT','0','$n','$codigoDeBarra')",$conn) or die (mysql_error());

	$codNew++;



/* Here is the list of the arguments
1 - Width
*/
$drawing        = new FDrawing(800,800,"barcode/img/barcode_$j.png",$color_white);
$drawing->init(); // You must call this method to initialize the image
$drawing->add_barcode($code_generated);
$drawing->draw_all();
$im             = $drawing->get_im();
// Next line create the little picture, the barcode is being copied inside
$im2            = imagecreate($code_generated->lastX,$code_generated->lastY);
imagecopyresized($im2, $im, 0, 0, 0, 0, $code_generated->lastX, $code_generated->lastY, $code_generated->lastX, $code_generated->lastY);
$drawing->set_im($im2);
// Header that says it is an image (remove it if you save the barcode to a file)
//header('Content-Type: image/png');
// Draw (or save) the image into PNG format.
$drawing->finish(IMG_FORMAT_PNG);
$ind++;
}


/*
*
*/
require('fpdf/fpdf.php');
//////

//////
//Creacin del objeto de la clase heredada
$pdf            =new FPDF();
$pdf->FPDF('l','mm','etiqueta');
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(0,0);

/*lLAMADAS Recibidas*/
for ($i         =0;$i<$c;$i++){

	$pdf->AddPage();
	$pdf->SetFont('arial','b',8);

// TITULO DEL TICKET
	$pdf->SetY(3);	$pdf->SetX(25);
	$pdf->Cell(12,4,'GOBERNACION DEL ESTADO BOLIVAR',0,0,'C',0);

	$pdf->SetY(6);	$pdf->SetX(25);
	$pdf->Cell(12,4,'AEROPUERTO INTERNACIONAL',0,0,'C',0);

	$pdf->SetY(9);	$pdf->SetX(25);
	$pdf->Cell(12,4,'"MANUEL CARLOS PIAR"',0,0,'C',0);

	$pdf->SetY(12);	$pdf->SetX(55);
	$pdf->Cell(12,4,'RIF: G-20004063-7',0,0,'C',0);

// CODIGO DE BARRAS IMG
	$pdf->Image('barcode/img/barcode_'.$i.'.png','8','18','64','','','');

	$pdf->SetY(30);	$pdf->SetX(30);
	$pdf->Cell(15,0,$codigoDeBarra,0,0,'C',0);

//TIPO DE TASA
	$pdf->SetFont('arial','b',7);
	$pdf->Ln(5);	$pdf->SetX(15);
	$pdf->Cell(5,5,'Tasa Aeroportuaria '.$nombT.'     BS. '.$t,0,0,'',0);

// ID AEROPUERTO
	$pdf->SetFont('arial','b',3.5);
	$pdf->SetY(3);	$pdf->SetX(84);
	$pdf->Cell(8,4,'GOBERNACION DEL ESTADO BOLIVAR',0,0,'C',0);
	$pdf->SetY(5);	$pdf->SetX(84);
	$pdf->Cell(9,4,'AEROPUERTO INTERNACIONAL',0,0,'C',0);
	$pdf->SetY(7);	$pdf->SetX(84);
	$pdf->Cell(9,4,'"MANUEL CARLOS PIAR"',0,0,'C',0);



//ZONA AEROPORTURIA
	$pdf->SetFont('arial','b',24);
	$pdf->Ln(7);	$pdf->SetX(88);
	$pdf->Cell(0,0,'PZO',0,0,'C',0);

//PRECIO BS. TICKET DESPRENDIBLE
	$pdf->SetFont('arial','',11);
	$pdf->Ln(5);	$pdf->SetX(81);
	$pdf->Cell(12,4,'BS. '.$t,0,0,'C',0);


// COPIA CODIGO
	$pdf->Image('barcode/img/barcode_'.$i.'.png','76','24','24','','','');


}
$pdf->Output();
?>