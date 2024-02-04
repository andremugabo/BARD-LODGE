<?php
session_start();
require_once '../DAO/OrdersDao.php';
require_once '../DAO/MetricDao.php';

$action = $_GET['action'];
$orderDaoObj = new OrdersDao();
$orderObj = new Orders;
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

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
            
    default:
    header('location:../../');
    session_destroy();    
    break;    
    }
?>