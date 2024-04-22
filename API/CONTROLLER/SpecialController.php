<?php
session_start();
require_once '../DAO/SpecialDao.php';
require_once '../DAO/MetricDao.php';
require_once '../DAO/IncomeDetailsDao.php';

$action = $_GET['action'];
$specialDaoObj = new SpecialDao();
$specialObj = new Special;
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$inObjDao = new IncomeDetailsDao();
$inObj = new IncomeDetails();

switch($action){
    case 'insert':
        if(isset($_POST['CreateSpecial'])){
            //get session id
            $s_id = $_GET['s_id'];
            // echo $s_id;
            $presentSpecial = $specialDaoObj->countSpecial();
            // echo $presentSpecial;
            $count = $presentSpecial + 1;

            if($count < 10){
                $o_ref = "S-000".$count;
            }else if($count >= 10 && $count < 100){
                $o_ref = "S-00".$count;
            }else if($count >= 100 && $count < 1000){
                $o_ref = "S-0".$count;
            }else{
                $o_ref = "S-".$count;
            }
            $e_id = $_SESSION['logged']['E_ID'];
            echo $e_id;
            $specialObj->setORef($o_ref);
            $specialObj->setEId($e_id);
            $specialObj->setSId($s_id);
            //create an special
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = "SPECIAL EVENT CREATED SUCCESSFULLY ";
            $metricObj->setMDesc($mDesc);
            //to review after sessions(Done)
            if(isset($_SESSION['currentSession']))
            {
                $metricObj->setSId($_SESSION['currentSession']);

            }
            else
            {
                $metricObj->setSId(null);
            }
            $_SESSION['success_msg'] =" SPECIAL EVENT $O_REF CREATED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $specialDaoObj->createSpecials($specialObj);
            // header("location:../../PAGES/SPECIALEVENT/");
        }else{
            // header("location:../../PAGES/SPECIALEVENT/");
        }
        break;
    case 'pay':
        if(isset($_POST['placeSpecial'])){
            if(!empty($_POST['o_amount']) && !empty($_POST['payment_mode'])){
                $o_id = $_GET['special'];
                $specialObj->setOAmount($_POST['o_amount']);
                $specialObj->setPaymentMode($_POST['payment_mode']);
                $specialObj->setCName($_POST['c_name']);
                $specialObj->setCPhone($_POST['c_phone']);
                $specialObj->setOId($o_id);
                

                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " special PAID SUCCESSFULLY ";
                $metricObj->setMDesc($mDesc);
                //to review after sessions(Done)
                if(isset($_SESSION['currentSession']))
                {
                    $metricObj->setSId($_SESSION['currentSession']);
    
                }
                else
                {
                    $metricObj->setSId(null);
                }
                $_SESSION['success_msg'] =" SPECIAL ORDER PAID SUCCESSFULLY!!!";
                $metricDaoObj->createMetric($metricObj);
                $specialDaoObj->updatePaySpecials($specialObj);
                // header("location:../../PAGES/SPECIALEVENT/");


            }
        }
        
        break;
    case 'paymentMode':
        $o_ref = $_GET['o_ref'];
        $s_id = $_SESSION['currentSession'];
        $specialObj->setORef($o_ref);
        $getspecial = $specialDaoObj->selectspecialByIdAndPaid($specialObj);
        print_r($getspecial);
        if($getspecial['payment_mode']==="DEBT"){
        $ind_name = $getspecial['payment_mode'];
        $ind_details = "DEPT PAYED BY ".$getspecial['c_name']."  ON special WITH A REFERENCE ".$o_ref;
        $ind_amount =$getspecial['O_AMOUNT'];  
        $inObj->setSId($s_id);
        $inObj->setIndName($ind_name);
        $inObj->setIndDetails($ind_details);
        $inObj->setIndAmount($ind_amount);
        $inObjDao->createIncome($inObj);
        $specialDaoObj->updatePaymentMode($specialObj);

        $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " DEBT PAID SUCCESSFULLY BY ".$getspecial['c_name'];
                $metricObj->setMDesc($mDesc);
                //to review after sessions(Done)
                if(isset($_SESSION['currentSession']))
                {
                    $metricObj->setSId($_SESSION['currentSession']);
    
                }
                else
                {
                    $metricObj->setSId(null);
                }
                $_SESSION['success_msg'] =" DEBT PAID SUCCESSFULLY BY ".$getspecial['c_name']." ON special WITH A REFERENCE ".$o_ref;
                $metricDaoObj->createMetric($metricObj);
                header("location:../../PAGES/REPORTS/debtReport.php");

        }else{
            $_SESSION['fail_msg']="ERROR THIS special DOES NOT HAVE A DEBT CHECK AGAIN PLEASE";
            header("location:../../PAGES/REPORTS/debtReport.php");
        }

       
        break;  
    case 'special':
        if(isset($_POST['CreateSpecial'])){
            //get session id
            $s_id = $_GET['s_id'];
            $table = $_GET['table'];
            $presentSpecial = $specialDaoObj->countSpecial();
            $count = $presentSpecial + 1;

            if($count < 10){
                $o_ref = "S-000".$count;
            }else if($count >= 10 && $count < 100){
                $o_ref = "S-00".$count;
            }else if($count >= 100 && $count < 1000){
                $o_ref = "S-0".$count;
            }else{
                $o_ref = "S-".$count;
            }
            $e_id = $_SESSION['logged']['E_ID'];
            $specialObj->setORef($o_ref);
            $specialObj->setEId($e_id);
            $specialObj->setSId($s_id);
            $specialObj->setOTable($table);
            //create an special
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = "SPECIAL special CREATED SUCCESSFULLY ";
            $metricObj->setMDesc($mDesc);
            //to review after sessions(Done)
            if(isset($_SESSION['currentSession']))
            {
                $metricObj->setSId($_SESSION['currentSession']);

            }
            else
            {
                $metricObj->setSId(null);
            }
            $_SESSION['success_msg'] =" SPECIAL EVENT $o_ref CREATED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $specialDaoObj->createSpecialSpecials($specialObj);
            header("location:../../PAGES/SPECIALEVENT/");
        }else{
            header("location:../../PAGES/SPECIALEVENT/");
        }
        break;      
            
    default:
    header('location:../../');
    session_destroy();    
    break;    
    }
?>