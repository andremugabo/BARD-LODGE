<?php
session_start();
require_once '../DAO/Voided_orderDao.php';
require_once '../DAO/OrdersDao.php';
require_once '../DAO/OrderDetailsDao.php';
require_once '../DAO/SStockDao.php';
require_once '../DAO/UnityDao.php';
require_once '../DAO/MetricDao.php';


$action = $_GET['action'];
$voidDao = new Voided_orderDao();
$voidObj = new Voided_order();
$orderDao = new OrdersDao();
$orderObj = new Orders();
$orderDetailsDao = new OrderDetailsDao();
$orderDetailsObj = new OrderDetails();
$sStockDao = new SStockDao();
$sStockObj = new SStock();
$unityDao = new UnityDao();
$unityObj = new Unity();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();



switch($action){
    case 'insert':

        if(isset($_POST['voidProduct'])){
            if(!empty($_POST['e_id']) && !empty($_POST['o_id']) && !empty($_POST['p_qty']) && !empty($_POST['p_id']) && !empty($_POST['unity_id']) && !empty($_POST['new_qty'])){
              if($_POST['new_qty'] <= $_POST['p_qty']){
                $newOrderQty = $_POST['p_qty'] - $_POST['new_qty'];
                $sStockObj->setPId($_POST['p_id']);
                $SStockCurrentQty = $sStockDao->selectProductQty($sStockObj);
                // print_r($SStockCurrentQty['p_qty']);
                $newSStockQty = $_POST['new_qty'] + $SStockCurrentQty['p_qty'];
                $voidObj->setOId($_POST['o_id']);
                $voidObj->setEId($_POST['e_id']);
                $voidObj->setPId($_POST['p_id']);
                $voidObj->setPQty($_POST['new_qty']);
                $voidObj->setUnityId($_POST['unity_id']);
                $voidObj->setVReason($_POST['v_reason']);
                $o_ref = $_POST['o_ref'];


                if($newOrderQty > 0){
                    $orderDetailsObj->setOdId($_POST['od_id']);
                    $orderDetailsObj->setPQty($newOrderQty);
                    $sStockObj->setPQty($newSStockQty);
                    $sStockDao->updateVoidedProductQty($sStockObj);
                    $orderDetailsDao->updateQtyOnVoidOrderDetails($orderDetailsObj);
                    $voidDao->createVoidOrder($voidObj);

                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = "A PRODUCT IS VOIDED";
                    $metricObj->setMDesc($mDesc);
                    // //to review after sessions(Done)
                    if(isset( $_SESSION['currentSession']))
                    {
                        $metricObj->setSId($_SESSION['currentSession']);
    
                    }
                    else
                    {
                        $metricObj->setSId(null);
                    }
                    $_SESSION['success_msg'] ="THE PRODUCT IS VOIDED SUCCESSFULLY!!!";
                    $metricDaoObj->createMetric($metricObj);
                    header("location:../../PAGES/ORDERS/voidOrder.php?o_ref=$o_ref");
                }else{
                    $orderDetailsObj->setOdId($_POST['od_id']);
                    $orderDetailsObj->setPQty($newOrderQty);
                    $sStockObj->setPQty($newSStockQty);
                    $sStockDao->updateVoidedProductQty($sStockObj);
                    $orderDetailsDao->deleteOrderDetails($orderDetailsObj);
                    $voidDao->createVoidOrder($voidObj);


                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = "A PRODUCT IS VOIDED ";
                    $metricObj->setMDesc($mDesc);
                    // //to review after sessions(Done)
                    if(isset( $_SESSION['currentSession']))
                    {
                        $metricObj->setSId($_SESSION['currentSession']);
    
                    }
                    else
                    {
                        $metricObj->setSId(null);
                    }
                    $_SESSION['success_msg'] ="THE PRODUCT IS VOIDED SUCCESSFULLY !!!";
                    $metricDaoObj->createMetric($metricObj);
                    header("location:../../PAGES/ORDERS/voidOrder.php?o_ref=$o_ref");
                }





                
              }else{
                $_SESSION['fail_msg']="THERE IS NO SUCH QUANTITY IN THIS ORDER";
                header("location:{$_SERVER['HTTP_REFERER']}");
              }
            }else{
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
        }else{
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
       
        break;
    default:
    break;
}    
















?>