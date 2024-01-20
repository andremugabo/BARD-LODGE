<?php
session_start();
require_once '../DAO/OrdersDao.php';
require_once '../DAO/MetricDao.php';

$action = $_GET['action'];
$gStockDaoObj = new OrdersDao();
$gStockObj = new Orders;
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action){
    case 'insert':
        if(isset($_POST['CreateOrder'])){

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