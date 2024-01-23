<?php
session_start();
require_once '../DAO/OrderDetailsDao.php';
require_once '../DAO/MetricDao.php';
require_once '../DAO/ProductCategoryDao.php';
require_once '../DAO/OrdersDao.php';

$action = $_GET['action'];
$orderDetailsDao = new OrderDetailsDao();
$orderDetails = new OrderDetails();
$productCategoryDaoObj = new ProductCategoryDao();
$productCategoryObj = new ProductCategory();
$orderDaoObj = new OrdersDao();
$orderObj = new Orders;
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action){
    case 'insert':
        if(isset($_POST['placeOrder'])){
                if(!empty($_POST['p_qty'])){
                    $orderDetails->setSId($_SESSION['currentSession']);
                    $orderObj->setORef($_GET['o_ref']);
                    $orderInfo = $orderDaoObj->selectOrderById($orderObj);
                    $orderDetails->setOId($orderInfo['O_ID']);
                    $orderDetails->setPId($_POST['p_id']);
                    $productCategoryObj->setPcId($_POST['pc_id']);
                    $categoryInfo = $productCategoryDaoObj->selectProductCategoryByPcId($productCategoryObj);
                    $orderDetails->setPtId($categoryInfo['PT_ID']);
                    $orderDetails->setPQty($_POST['p_qty']);
                    $orderDetails->setUnityId($_POST['unity_id']);
                    $orderDetails->setPPrice($_POST['p_pprice']);
                    $orderDetails->setSPrice($_POST['p_sprice']);

                    //CREATE

                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = "  ORDER PLACED ON ".$_GET['o_ref']." ";
                    $metricObj->setMDesc($mDesc);
                    //to review after sessions(Done)
                    if(isset( $_SESSION['currentSession']))
                    {
                        $metricObj->setSId($_SESSION['currentSession']);

                    }
                    else
                    {
                        $metricObj->setSId(null);
                    }
                    //CHECK THE IF THE PRODUCT EXIST ON ORDER FIRST THE ADJUST QUANTITY
                    $result = $metricDaoObj->createMetric($metricObj);
                    // $orderDetailsDao->createOrderDetails($orderDetails);
                    header("location:{$_SERVER['HTTP_REFERER']}");



                }else{
                    $_SESSION['fail_msg']="FIRST ENTER THE QUANTITY OF THE PRODUCT";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                }
        
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