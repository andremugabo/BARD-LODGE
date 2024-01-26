 <?php
session_start();
include('../../ASSETS/fpdf182/fpdf.php');






$pdf = new FPDF('P','mm','A4');
$pdf->AddPage('P','A4',0);

$pdf->SetFont('Arial','B',12);

// $pdf->Cell(40,10,'Hello World!');
 $pdf->SetFillColor(0,255,0);
$pdf->Cell(60,20,'',0,0);
$pdf->Image('../../ASSETS/IMAGES/xlounge.jpg',10,10,30,30,'jpg');
$pdf->Cell(65,20,'X=LOUNGE PRODUCTS CODES',0,0,'C',true);
$pdf->Cell(25,20,'',0,1);
$pdf->Image('../../ASSETS/IMAGES/xlounge.jpg',170,10,30,30,'jpg');


$pdf->Ln(20);
$pdf->Cell(200,10,'X-LOUNGE',0,1,'L');
$pdf->Cell(200,10,'RESTO & BAR Services',0,1,'L');
$pdf->Cell(150,10,'Kigali Modern Market',0,1,'L');
$pdf->Cell(35,10,'Nyabugogo',0,1,'L');
$pdf->Cell(35,10,'Tel:(+250)788811115',0,1,'L');



$pdf->Ln(30);

$pdf ->Cell(0,10,'DESCRIPTION : DRINKS',0,1,'C');

$pdf->SetFillColor(0,255,0);

$pdf->Cell(10,10,'#',1,0,'C',true);
$pdf->Cell(40,10,'DESCRIPTION',1,0,'C',true);
$pdf->Cell(30,10,'CATEGORY',1,0,'C',true);
$pdf->Cell(85,10,'PRODUCT NAME',1,0,'C',true);
$pdf->Cell(25,10,'CODES ',1,1,'C',true);
// $pdf->Cell(25,10,'BRAND',1,1,'C',true);


require_once"../../API/MODEL/productsModel.php"; 
$products = new productsModel();

$num = 0;
if($products->selectCategoryDrinks()):
	foreach ($products->selectCategoryDrinks() as $key ) {
		$num++; 
	 $pdf->Cell(10,10,$num,1,0,'C');
	 $pdf->Cell(40,10,$key['pd_name'],1,0,'C');
	 $pdf->Cell(30,10,$key['cat_name'],1,0,'C');
	 $pdf->Cell(85,10,$key['p_name'],1,0,'C');
	 $pdf->Cell(25,10,$key['p_code'],1,1,'C');
	 // $pdf->Cell(25,10,$key['p_brand'],1,1,'C');
	 
	 
	}
endif;	 



$pdf->Ln(30);

$pdf ->Cell(0,10,'DESCRIPTION : (ICYOKEZO & RESTAURANT)',0,1,'C');

$pdf->SetFillColor(0,255,0);

$pdf->Cell(10,10,'#',1,0,'C',true);
$pdf->Cell(40,10,'DESCRIPTION',1,0,'C',true);
$pdf->Cell(41,10,'CATEGORY',1,0,'C',true);
$pdf->Cell(70,10,'PRODUCT NAME',1,0,'C',true);
$pdf->Cell(26,10,'CODES ',1,1,'C',true);


require_once"../../API/MODEL/productsModel.php"; 
$products = new productsModel();

$bnum = 0;
if($products->selectCategoryFoods()):
	foreach ($products->selectCategoryFoods() as $key ) {
		$bnum++; 
	 $pdf->Cell(10,10,$bnum,1,0,'C');
	 $pdf->Cell(40,10,$key['pd_name'],1,0,'C');
	 $pdf->Cell(41,10,$key['cat_name'],1,0,'C');
	 $pdf->Cell(70,10,$key['p_name'],1,0,'C');
	 $pdf->Cell(26,10,$key['p_code'],1,1,'C');
	 
	 
	}
endif;	 



$pdf->Output();



?>
 