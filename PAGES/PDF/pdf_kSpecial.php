<?php
session_start();
require_once"../../API/DAO/SpecialDao.php";
// echo $_GET['o_ref'];
$specialDaoObj = new SpecialDao();
$specialObj = new Special();
if (isset($_GET['o_ref'])) {
	$o_reference = $_GET['o_ref'];
	$specialObj->setORef($_GET['o_ref']);
}
// print_r($specialObj->getORef());
$specialInfo = $specialDaoObj->selectSpecialById($specialObj);
// print_r($specialInfo);
require_once"../../API/DAO/specialDetailsDao.php";
$specialDetailsDao = new SpecialDetailsDao();
$specialDetails = new SpecialDetails();
// print_r($specialInfo['O_ID']);
$specialDetails->setOId($specialInfo['O_ID']);
$values = $specialDetailsDao->selectSpecialDetailsByOId($specialDetails);
// print_r($values);
require_once"../../API/DAO/EmployeesDao.php";

$employee = new EmployeesDao();
$emp = new Employees();
$employee_id = $_SESSION['logged']['E_ID'];
$userName = $_SESSION['logged']['FIRSTNAME'];
$emp->setEId($employee_id);

$employeeData = $employee->getEmployeeById($emp);
// print_r($employeeData);


$employee_names = $employeeData['LASTNAME']." ".$employeeData['FIRSTNAME'];
$employee_regnumber = $employeeData['E_REGNUMBER'];
$employee_role = $employeeData['E_ROLE'];
$employee_phone = $employeeData['E_PHONE'];

// print_r($values);

include('../../ASSETS/fpdf182/fpdf.php');




$pdf = new FPDF('P','mm',array(58,120));


$pdf->SetMargins(4.175, 3.175, 4.175);

$pdf->AddPage('P',array(58,120),0);
$pdf->SetFont('Arial','I',5);


$pdf->Cell(45,5,'GWC  / KITCHEN  Special NOTE',0,1,'C');

// $pdf->Ln(2);
$pdf->Cell(45,5,'Tel:(+250) 788 652 595',0,1,'C');
$pdf->Cell(45,5,'TIN:122270330',0,1,'C');
$pdf->Cell(45,5,'Time: '. $specialInfo['O_DATE'],0,1,'C');
$pdf->Cell(45,5,'Ref No :'.$o_reference,0,1,'C');

// $pdf->Line(10,60,70,60);

$pdf->Ln(0.5);
// hano
// $pdf->Cell(5,5,'---------------------------------------------------------------------------------',0,1,'L');


// $pdf->Line(10,70,70,70);

$pdf->Ln(6);

	 	 $pdf->SetFillColor(245,245,220);


$pdf->Cell(5,5,'#',0,0,'C',true);
$pdf->Cell(20,5,'Item',0,0,'C',true);
$pdf->Cell(4,5,'Qty',0,0,'C',true);
$pdf->Cell(5,5,'U/P',0,0,'CL',true);
$pdf->Cell(15,5,'Total',0,1,'C',true);

$pdf->Ln(2);


require_once"../../API/DAO/SpecialDetailsDao.php";
$specialDetailsDao = new SpecialDetailsDao();
$specialDetails = new SpecialDetails();
$specialDaoObj = new SpecialDao();
$SpecialObj = new Special;
$specialObj->setORef($_GET['o_ref']);
$specialInfo = $specialDaoObj->selectSpecialById($specialObj);
// echo$specialInfo['O_ID'];
$specialDetails->setOId($specialInfo['O_ID']);
$selectedSpecial = $specialDetailsDao->selectSpecialDetailsByOIdAndByFood($specialDetails);
// print_r($selectedSpecial);
$num = 0;
$total = 0;
$sum = 0;
if($selectedSpecial != null):
	foreach ($selectedSpecial as $item) {  $num++; 
		$total = $item['S_PRICE']*$item['P_QTY'];
		$sum += $total; 

 
	 $pdf->Cell(5,5,$num,0,0,'C');
	 $pdf->Cell(20,5,$item["P_NAME"],0,0,'C');
	 $pdf->Cell(4,5,$item["P_QTY"],0,0,'C');
	 $pdf->Cell(5,5,$item["S_PRICE"],0,0,'C');
	 $pdf->Cell(15,5,$total.'Frw',0,1,'C');
}
endif;
	//  $pdf->SetFillColor(255,204,229);
	 $pdf->Cell(19,5,'TOTAL',0,0,'L',true);
	 $pdf->Cell(30,5,number_format($sum).' FRW' ,0,1,'R',true);


$pdf->Ln(5);



$pdf->Cell(10,5,'Served By: '.$specialInfo['FIRSTNAME']." ".$specialInfo['LASTNAME'],0,1,'L');
$pdf->Cell(35,5,'Printed :'.date('Y-m-d/h:i:s'),0,1,'L');
$pdf->Cell(45,5,'THIS NOT OFFICIAL RECEIPT',0,1,'C');
$pdf->Cell(45,5,'CODE MOMO: ------- MURAKOZE',0,1,'C');
$pdf->Cell(45,5,'Powered By:MA Coding-Lab',0,1,'C');

$pdf->Output();





?>