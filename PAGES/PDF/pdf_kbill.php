<?php
session_start();
if (isset($_GET['ref'])) {
  $b_reference = $_GET['ref'];
}
require_once"../../API/MODEL/billsModel.php";
// $billDetails = new billsModel();
$values = $billDetails->selectBref($b_reference);
// print_r($values);
$waiter = $values['waiter'];

require_once"../../API/MODEL/employeeModel.php";

// $employee = new employeeModel();
$employee_id = $_SESSION['logged_user']['e_id'];
$userName = $_SESSION['logged_user']['u_name'];


$employeeData = $employee->selectOne($employee_id);
// print_r($employeeData);


$employee_names = $employeeData['e_names'];
$employee_regnumber = $employeeData['e_regnumber'];
$employee_role = $employeeData['e_role'];
$employee_email = $employeeData['e_email'];
$employee_phone = $employeeData['e_phone'];

// print_r($values);

include('../../ASSETS/fpdf182/fpdf.php');




$pdf = new FPDF('P','mm',array(58,120));

$pdf->SetMargins(4.175, 3.175, 4.175);


$pdf->AddPage('P','A4',0);
$pdf->SetFont('Arial','I',6);


$pdf->Cell(45,5,'X-Lounge / KITCHEN BILL ',0,1,'C');

$pdf->Ln(5);
$pdf->Cell(10,5,'Tel:(+250)788811115',0,0,'L');
$pdf->Cell(35,5,'Tin:109959171',0,1,'R');
$pdf->Cell(10,5,'Session: '.$values['sub_type'],0,0,'L');
$pdf->Cell(35,5,'Time: '. $values['o_date'],0,1,'R');

$pdf->Cell(10,5,'Waiter: '.$values['e_names'],0,1,'L');
$pdf->Cell(10,5,'Ref No:'.$b_reference,0,1,'L');


// $pdf->Line(10,60,70,60);

$pdf->Ln(0.5);
// hano
// $pdf->Cell(5,5,'---------------------------------------------------------------------------------',0,1,'L');


// $pdf->Line(10,70,70,70);

$pdf->Ln(6);

	 	 $pdf->SetFillColor(245,245,220);


$pdf->Cell(5,5,'#',0,0,'L',true);
$pdf->Cell(20,5,'Item',0,0,'L',true);
$pdf->Cell(4,5,'Qty',0,0,'L',true);
$pdf->Cell(5,5,'U/P',0,0,'L',true);
$pdf->Cell(15,5,'Total',0,1,'L',true);

$pdf->Ln(2);


require_once"../../API/MODEL/billDetailsModel.php";
// $billDetails = new billDetailsModel();
$b_reference = $_GET['ref'];
$num = 0;
$total = 0;
$sum = 0;
if($billDetails->selectRefKitcken($b_reference)):
foreach ($billDetails->selectRefKitcken($b_reference) as $billDetail) {  $num++; 
$total =  $billDetail['bd_quantity']*$billDetail['bd_sprice'];
$sum += $total;

 
	 $pdf->Cell(5,5,$num,0,0,'C');
	 $pdf->Cell(20,5,$billDetail["p_name"],0,0,'C');
	 $pdf->Cell(4,5,$billDetail["bd_quantity"],0,0,'C');
	 $pdf->Cell(5,5,$billDetail["bd_sprice"],0,0,'C');
	 $pdf->Cell(15,5,$total.'Frw',0,1,'C');
}
endif;
	 $pdf->SetFillColor(255,204,229);
	 $pdf->Cell(19,5,'TOTAL',0,0,'L',true);
	 $pdf->Cell(30,5,number_format($sum).' FRW' ,0,1,'C',true);


$pdf->Ln(5);



$pdf->Cell(10,5,'Printed by:'.$employee_names,0,1,'L');
$pdf->Cell(10,5,'Time :'.date('Y-m-d/h:i:s'),0,1,'L');
$pdf->Cell(48,5,'THANK YOU FOR CHOOSING X-LOUNGE',0,1,'C');
$pdf->Cell(45,5,'Powered By:MA Coding-Lab',0,1,'C');

$pdf->Output();





?>