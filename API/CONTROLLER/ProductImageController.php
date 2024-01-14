<?php
session_start();
require_once '../DAO/ProductImagesDao.php';
require_once '../DAO/MetricDao.php';
require_once '../MODEL/ProductImages.php';

$action = $_GET['action'];
$productCategoryDaoObj = new ProductImagesDao();
$productCategoryObj = new ProductImages();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action)
{
    case 'insert':
        break;
    case 'edit':
        break;    



    default:
        header('location:../../');
        session_destroy();    
        break;    

}





?>