<?php
session_start();
include('../../ASSETS/fpdf182/fpdf.php');






$pdf = new FPDF('P','mm','A4');
$pdf->AddPage('P','A4',0);

$pdf->SetFont('Arial','B',7);




$pdf->Ln(20);
$pdf->Cell(200,10,'GREEN WORLD CORNER',0,1,'L');
$pdf->Cell(200,10,'DAILY SALES REPORT',0,1,'L');
$pdf->Cell(150,10,'Kigali, KG 730 ST ',0,1,'L');
$pdf->Cell(35,10,'TIN:103477797',0,1,'L');
$pdf->Cell(35,10,'Tel:(+250)788-322-151',0,1,'L');



$pdf->Ln(30);

// $pdf ->Cell(0,10,'DESCRIPTION : DRINKS',0,1,'C');

$pdf->SetFillColor(0,255,0);

$pdf->Cell(10,10,'#',1,0,'C',true);
$pdf->Cell(50,10,'PRODUCTS',1,0,'C',true);
$pdf->Cell(15,10,'UNITY',1,0,'C',true);
$pdf->Cell(10,10,'QTY',1,0,'C',true);
$pdf->Cell(35,10,'PPRICE ',1,0,'C',true);
$pdf->Cell(35,10,'SPRICE',1,0,'C',true);
$pdf->Cell(35,10,'PROFIT',1,1,'C',true);


require_once"../../API/DAO/Closing_sales_reportDao.php"; 
$closingSalesReportDao = new Closing_sales_reportDao();
$closingSalesReportObj = new Closing_sales_report();
$s_ref = $_GET['s_ref'];
$closingSalesReportObj->setSRef($s_ref);
$dailySalesReport =$closingSalesReportDao->selectSReportBySRef($closingSalesReportObj);
// print_r($dailySalesReport);
$num = 0;
$total = 0;
$sumSPrice = 0;
$sumPPrice = 0;
$sumProfitPrice = 0;
$profit = 0;
if($dailySalesReport != null):
    foreach($dailySalesReport as $items){$num++;
    $profit = $items['P_SPRICE'] - $items['P_PPRICE'];
    $totalSellingPrice = $items['P_QTY'] * $items['P_SPRICE'];
    $totalPurchasingPrice = $items['P_QTY'] * $items['P_PPRICE'];
    $totalProfitPrice =  $profit * $items['P_QTY'];
   
    $sumSPrice+=$totalSellingPrice;
    $sumPPrice+=$totalPurchasingPrice;
    $sumProfitPrice+=$totalProfitPrice;
		
	 $pdf->Cell(10,10,$num,1,0,'C');
	 $pdf->Cell(50,10,$items['P_NAME'],1,0,'C');
	 $pdf->Cell(15,10,$items['UNITY_NAME'],1,0,'C');
	 $pdf->Cell(10,10,$items['P_QTY'],1,0,'C');
	 $pdf->Cell(35,10,number_format($items['P_PPRICE'])." Frw",1,0,'C');
	 $pdf->Cell(35,10,number_format($items['P_PPRICE'])." Frw",1,0,'C');
	 $pdf->Cell(35,10,number_format($profit)." Frw",1,1,'C');
	 
	 
	}
endif;	 
$pdf->Cell(85,10,'TOTAL',1,0,'L');
$pdf->Cell(35,10,number_format($sumPPrice)." Frw",1,0,'C');
$pdf->Cell(35,10,number_format($sumSPrice)." Frw",1,0,'C');
$pdf->Cell(35,10,number_format($sumProfitPrice)." Frw",1,1,'C');






$pdf->Output();



?>