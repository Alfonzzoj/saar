<?php
 $row=$_GET['id'];?>
<?php
// Define variable to prevent hacking
define('IN_CB',true);
// Including all required classes
require('class/index.php');
require('class/FColor.php');
require('class/BarCode.php');
require('class/FDrawing.php');
// including the barcode technology
include('class/code93.barcode.php');
// Creating some Color (arguments are R, G, B)
$color_black = new FColor(0,0,0);
$color_white = new FColor(255,255,255);//color de fondo de la imagen 255 = blanco
/* Here is the list of the arguments:
1 - Ancho
2 - Color de las barras
3 - Color of spaces
4 - Resolucion
5 - Text
6 - Text Font (0-5) si se quiere mostrar el numero al cual corresponde el codigo, para ocultarlo se deja con 0 */
// Ojo! si la imagen ya esta en la carpeta img la sustituye!
	$code_generated = new code93(40,$color_black,$color_white,1,$row,3);
	/* Here is the list of the arguments
	1 - Width
	2 - Height
	3 - Filename (empty : display on screen)
	4 - Background color */
	$drawing = new FDrawing(800,800,'',$color_white);
	$drawing->init(); // You must call this method to initialize the image
	$drawing->add_barcode($code_generated);
	$drawing->draw_all();
	$im = $drawing->get_im();
	// Next line create the little picture, the barcode is being copied inside
	$im2 = imagecreate($code_generated->lastX,$code_generated->lastY);
	imagecopyresized($im2, $im, 0, 0, 0, 0, $code_generated->lastX, $code_generated->lastY, $code_generated->lastX, $code_generated->lastY);
	$drawing->set_im($im2);
	// Header that says it is an image (remove it if you save the barcode to a file)
	header('Content-Type: image/png');
	// Draw (or save) the image into PNG format.
	$drawing->finish(IMG_FORMAT_PNG);