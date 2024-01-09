<?php
session_start();
require_once '../DAO/PricesDao.php';
require_once '../DAO/MetricDao.php';

$priceObj = new Price();
$priceDaoObj = new PricesDao();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$action = $_GET['action'];


switch($action){
    case 'insert':
        echo "insert";
        $priceObj->setPId($_POST['p_id']);
        $priceObj->setPPrice($_POST['pprice']);
        $priceObj->setEPrice($_POST['eprice']);
        $priceObj->setSPrice($_POST['sprice']);
        $priceObj->setUnityId($_POST['unity_id']);
        $feedback = $priceDaoObj->checkProductPriceExists($priceObj);
        echo $feedback;

        if($feedback == 0)
        {
            //set user id for metric 
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = "PRICE  CREATED ";
            $metricObj->setMDesc($mDesc);
            //to review after sessions
            $metricObj->setSId(null);
            $_SESSION['success_msg'] ="PRICE CREATED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $priceDaoObj->createPrice($priceObj);
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        else
        {
            $_SESSION['fail_msg']="PRICE IS ALREADY  ACTIVE IT SHOULD BE DISABLED FIRST";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }

        break;
}








?>