<?php
session_start();
require_once '../DAO/GStockDao.php';
require_once '../DAO/MetricDao.php';

$action = $_GET['action'];
$gStockDaoObj = new GStockDao();
$gStockObj = new GStock();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action){
    case 'insert':
        if(isset($_POST['addProductIS'])){
            if(!empty($_POST['p_id']) && !empty($_POST['qty'])){
                $gStockObj->setPId($_POST['p_id']);
                $gStockObj->setPQty($_POST['qty']);
                //to review
                $gStockObj->setSId($_SESSION['currentSession']);

            }else{
                $_SESSION['fail_msg']="FILL OUT ALL  TEXT FIELD !!";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
            

        }else{
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        
        break;
}

?>