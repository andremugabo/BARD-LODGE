<?php
session_start();
require_once '../DAO/ProductTypeDao.php';
require_once '../DAO/MetricDao.php';
require_once '../MODEL/ProductType.php';

$action = $_GET['action'];
$productTypeDaoObj = new ProductTypeDao();
$productTypeObj = new ProductType();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();



switch($action){
    case 'insert':
        echo $_POST['pt_name'];
        break;
    case 'edit':
        break;    
}






?>