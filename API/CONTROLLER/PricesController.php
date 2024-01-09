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
        break;
}








?>