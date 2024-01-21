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
            header("location:{$_SERVER['HTTP_REFERER']}");










        }else{
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break;
            
    default:
    header('location:../../');
    session_destroy();    
    break;    
    }
?>