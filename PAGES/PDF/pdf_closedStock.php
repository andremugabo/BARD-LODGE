 <?php
session_start();
include('../../ASSETS/fpdf182/fpdf.php');

if(isset($_GET['view'])){
    $cs_date = $_GET['view'];
}




$pdf = new FPDF('P','mm','A4');
$pdf->AddPage('P','A4',0);

$pdf->SetFont('Arial','B',12);

// $pdf->Cell(40,10,'Hello World!');
 $pdf->SetFillColor(0,255,0);
$pdf->Cell(60,20,'',0,0);
$pdf->Image('../../ASSETS/IMAGES/xlounge.jpg',10,10,30,30,'jpg');
$pdf->Cell(65,20,' CLOSED STOCK ON '.$cs_date,0,0,'C',true);
$pdf->Cell(25,20,'',0,1);
$pdf->Image('../../ASSETS/IMAGES/xlounge.jpg',170,10,30,30,'jpg');


$pdf->Ln(20);
$pdf->Cell(200,10,'X-LOUNGE',0,1,'L');
$pdf->Cell(200,10,'RESTO & BAR Services',0,1,'L');
$pdf->Cell(150,10,'Kigali Modern Market',0,1,'L');
$pdf->Cell(35,10,'Nyabugogo',0,1,'L');
$pdf->Cell(35,10,'Tel:(+250)788811115',0,1,'L');



$pdf->Ln(30);

// $pdf ->Cell(0,10,'DESCRIPTION : DRINKS',0,1,'C');

$pdf->SetFillColor(0,255,0);

$pdf->Cell(10,10,'#',1,0,'C',true);
$pdf->Cell(70,10,'PRODUCTS',1,0,'C',true);
$pdf->Cell(20,10,'CODE',1,0,'C',true);
$pdf->Cell(40,10,'QUANTITY',1,0,'C',true);
$pdf->Cell(25,10,'VALUE ',1,0,'C',true);
$pdf->Cell(25,10,'TOTAL',1,1,'C',true);


require_once"../../API/MODEL/stockModel.php"; 
          $stocks = new stockModel();

          $num = 0;
          $total = 0;
          $sum = 0;
if($stocks->selectSessionInClosedStock($cs_date)):
          foreach ($stocks->selectSessionInClosedStock($cs_date) as $stock) { 
               $num++;
               $total= $stock['cs_qty'] * $stock['p_price'];
               $sum+=$total; 
		
	 $pdf->Cell(10,10,$num,1,0,'C');
	 $pdf->Cell(70,10,$stock['p_name'],1,0,'C');
	 $pdf->Cell(20,10,$stock['p_code'],1,0,'C');
	 $pdf->Cell(40,10,$stock['cs_qty'],1,0,'C');
	 $pdf->Cell(25,10,$stock['p_price'],1,0,'C');
	 $pdf->Cell(25,10,number_format($total)." Frw",1,1,'C');
	 
	 
	}
endif;	 
$pdf->Cell(165,10,'TOTAL',1,0,'L');
$pdf->Cell(25,10,number_format($sum)." Frw",1,1,'R');


// $pdf->Ln(30);

// $pdf ->Cell(0,10,'DESCRIPTION : (ICYOKEZO & RESTAURANT)',0,1,'C');

// $pdf->SetFillColor(0,255,0);

// $pdf->Cell(10,10,'#',1,0,'C',true);
// $pdf->Cell(40,10,'DESCRIPTION',1,0,'C',true);
// $pdf->Cell(41,10,'CATEGORY',1,0,'C',true);
// $pdf->Cell(70,10,'PRODUCT NAME',1,0,'C',true);
// $pdf->Cell(26,10,'CODES ',1,1,'C',true);


// require_once"../../API/MODEL/productsModel.php"; 
// $products = new productsModel();

// $bnum = 0;
// if($products->selectCategoryFoods()):
// 	foreach ($products->selectCategoryFoods() as $key ) {
// 		$bnum++; 
// 	 $pdf->Cell(10,10,$bnum,1,0,'C');
// 	 $pdf->Cell(40,10,$key['pd_name'],1,0,'C');
// 	 $pdf->Cell(41,10,$key['cat_name'],1,0,'C');
// 	 $pdf->Cell(70,10,$key['p_name'],1,0,'C');
// 	 $pdf->Cell(26,10,$key['p_code'],1,1,'C');
	 
	 
// 	}
// endif;	 



$pdf->Output();



?>
 