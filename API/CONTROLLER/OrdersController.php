<?php
session_start();
require_once '../DAO/OrdersDao.php';
require_once '../DAO/MetricDao.php';
require_once '../DAO/IncomeDetailsDao.php';

$action = $_GET['action'];
$orderDaoObj = new OrdersDao();
$orderObj = new Orders;
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$inObjDao = new IncomeDetailsDao();
$inObj = new IncomeDetails();

switch($action){
    case 'insert':
        if(isset($_POST['CreateOrder'])){
            //get session id
            $s_id = $_GET['s_id'];
            echo $s_id;
            $presentOrders = $orderDaoObj->countOrder();
            echo $presentOrders;
            $count = $presentOrders + 1;

            if($count < 10){
                $o_ref = "O-000".$count;
            }else if($count >= 10 && $count < 100){
                $o_ref = "O-00".$count;
            }else if($count >= 100 && $count < 1000){
                $o_ref = "O-0".$count;
            }else{
                $o_ref = "O-".$count;
            }
            $e_id = $_SESSION['logged']['E_ID'];
            echo $e_id;
            $orderObj->setORef($o_ref);
            $orderObj->setEId($e_id);
            $orderObj->setSId($s_id);
            //create an order
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " ORDER CREATED SUCCESSFULLY ";
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
            $_SESSION['success_msg'] =" ORDER $O_REF CREATED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $orderDaoObj->createOrders($orderObj);
            header("location:../../PAGES/ORDERS/order.php");










        }else{
            header("location:../../PAGES/ORDERS/order.php");
        }
        break;
    case 'pay':
        if(isset($_POST['placeOrder'])){
            if(!empty($_POST['o_amount']) && !empty($_POST['payment_mode'])){
                $o_id = $_GET['order'];
                $orderObj->setOAmount($_POST['o_amount']);
                $orderObj->setPaymentMode($_POST['payment_mode']);
                $orderObj->setCName($_POST['c_name']);
                $orderObj->setCPhone($_POST['c_phone']);
                $orderObj->setOId($o_id);
                

                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " ORDER PAID SUCCESSFULLY ";
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
                $_SESSION['success_msg'] =" ORDER PAID SUCCESSFULLY!!!";
                $metricDaoObj->createMetric($metricObj);
                $orderDaoObj->updatePayOrders($orderObj);
                header("location:../../PAGES/ORDERS/order.php");


            }
        }
        
        break;
    case 'paymentMode':
        $o_ref = $_GET['o_ref'];
        $s_id = $_SESSION['currentSession'];
        $orderObj->setORef($o_ref);
        $getOrder = $orderDaoObj->selectOrderByIdAndPaid($orderObj);
        print_r($getOrder);
        if($getOrder['payment_mode']==="DEBT"){
        $ind_name = $getOrder['payment_mode'];
        $ind_details = "DEPT PAYED BY ".$getOrder['c_name']."ON ORDER WITH A REFERENCE ".$o_ref;
        $ind_amount =$getOrder['O_AMOUNT'];  
        $inObj->setSId($s_id);
        $inObj->setIndName($ind_name);
        $inObj->setIndDetails($ind_details);
        $inObj->setIndAmount($ind_amount);
        $inObjDao->createIncome($inObj);
        $orderDaoObj->updatePaymentMode($orderObj);

        $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " DEBT PAID SUCCESSFULLY BY ".$getOrder['c_name'];
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
                $_SESSION['success_msg'] =" DEBT PAID SUCCESSFULLY BY ".$getOrder['c_name']." ON ORDER WITH A REFERENCE ".$o_ref;
                $metricDaoObj->createMetric($metricObj);
                header("location:../../PAGES/REPORTS/debtReport.php");

        }else{
            $_SESSION['fail_msg']="ERROR THIS ORDER DOES NOT HAVE A DEBT CHECK AGAIN PLEASE";
            header("location:../../PAGES/REPORTS/debtReport.php");
        }

       
        break;    
            
    default:
    header('location:../../');
    session_destroy();    
    break;    
    }
?>