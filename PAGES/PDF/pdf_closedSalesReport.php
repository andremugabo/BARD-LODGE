<?php
session_start();
include('../../ASSETS/fpdf182/fpdf.php');






$pdf = new FPDF('P','mm','A4');
$pdf->AddPage('P','A4',0);

$pdf->SetFont('Arial','B',10);




$pdf->Ln(20);
$pdf->Cell(200,10,'GREEN WORLD CORNER',0,1,'L');
$pdf->Cell(200,10,'CLOSED SALES STOCK',0,1,'L');
$pdf->Cell(150,10,'Kigali, KG 730 ST ',0,1,'L');
$pdf->Cell(35,10,'TIN:103477797',0,1,'L');
$pdf->Cell(35,10,'Tel:(+250)788-322-151',0,1,'L');



$pdf->Ln(30);

// $pdf ->Cell(0,10,'DESCRIPTION : DRINKS',0,1,'C');

$pdf->SetFillColor(0,255,0);

$pdf->Cell(10,10,'#',1,0,'C',true);
$pdf->Cell(70,10,'PRODUCTS',1,0,'C',true);
$pdf->Cell(20,10,'CODE',1,0,'C',true);
$pdf->Cell(40,10,'QUANTITY',1,0,'C',true);
$pdf->Cell(25,10,'VALUE ',1,0,'C',true);
$pdf->Cell(25,10,'TOTAL',1,1,'C',true);


require_once"../../API/DAO/Closing_sales_stockDao.php"; 
$CStockDao = new Closing_sales_stockDao();
$CStockObj = new Closing_sales_stock();
$s_ref = $_GET['s_ref'];
$CStockObj->setSRef($s_ref);
$currentStock =$CStockDao->selectSStockBySid($CStockObj);
// print_r($currentStock);
$num = 0;
$total = 0;
$sum = 0;
if($currentStock != null):
    foreach($currentStock as $items){$num++;

    $total = $items['P_QTY'] * $items['P_PPRICE'];
    $sum+=$total;
		
	 $pdf->Cell(10,10,$num,1,0,'C');
	 $pdf->Cell(70,10,$items['P_NAME'],1,0,'C');
	 $pdf->Cell(20,10,$items['P_CODE'],1,0,'C');
	 $pdf->Cell(40,10,$items['P_QTY'],1,0,'C');
	 $pdf->Cell(25,10,$items['P_PPRICE'],1,0,'C');
	 $pdf->Cell(25,10,number_format($total)." Frw",1,1,'C');
	 
	 
	}
endif;	 
$pdf->Cell(160,10,'TOTAL',1,0,'L');
$pdf->Cell(30,10,number_format($sum)." Frw",1,1,'R');






$pdf->Output();



?>