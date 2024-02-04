<?php
session_start();
require_once '../DAO/OrderDetailsDao.php';
require_once '../DAO/MetricDao.php';
require_once '../DAO/ProductCategoryDao.php';
require_once '../DAO/OrdersDao.php';
require_once '../DAO/SStockDao.php';


$action = $_GET['action'];
$orderDetailsDao = new OrderDetailsDao();
$orderDetails = new OrderDetails();
$productCategoryDaoObj = new ProductCategoryDao();
$productCategoryObj = new ProductCategory();
$orderDaoObj = new OrdersDao();
$orderObj = new Orders;
$SStockDaoObj = new SStockDao();
$SStockObj = new SStock();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$productData = [];


switch($action){
    case 'insert':
        if(isset($_POST['placeOrder'])){
                if(!empty($_POST['p_qty']) && $_POST['p_qty'] > 0){
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
                    $SStockObj->setPId($_POST['p_id']);
                    $isProductExistInSalesStock = $SStockDaoObj->checkIfProductExistSStock($SStockObj);
                    if($isProductExistInSalesStock > 0){
                        $qtyInSaleStock = $SStockDaoObj->selectProductQty($SStockObj);
                        if($qtyInSaleStock['p_qty'] >= $_POST['p_qty']){
                            //new quantity in sales stock
                           $newQtyInSalesStock = $qtyInSaleStock['p_qty'] - $_POST['p_qty'];
                           $SStockObj->setPQty($newQtyInSalesStock);
                           $SStockObj->setPId($_POST['p_id']);

                           $orderDetails->setOId($orderInfo['O_ID']);
                           $orderDetails->setPId($_POST['p_id']);
                           $isProductExistInOrderDetails = $orderDetailsDao->checkProductOnOrderDetailsExists($orderDetails);
                          
                           
                           if($isProductExistInOrderDetails === 0){
                                //update product in sales stock
                                $SStockDaoObj->updateProductQtyOnOrder($SStockObj);
                                $result = $metricDaoObj->createMetric($metricObj);
                                $orderDetailsDao->createOrderDetails($orderDetails);
                                header("location:{$_SERVER['HTTP_REFERER']}");
                           }else{
                                //get quantity in order details
                                $quantityInOrderDetails = $orderDetailsDao->selectProductQtyOrderDetails($orderDetails);
                                print_r($quantityInOrderDetails['p_qty']);
                                $newQtyInOrderDetails = $quantityInOrderDetails['p_qty'] + $_POST['p_qty'];
                                $orderDetails->setPQty($newQtyInOrderDetails);
                                //update product in sales stock
                                $SStockDaoObj->updateProductQtyOnOrder($SStockObj);
                                $orderDetailsDao->updateQtyOnOrderDetails($orderDetails);
                                header("location:{$_SERVER['HTTP_REFERER']}");
                           }

                          
                           
                          
                        }else{
                            $_SESSION['fail_msg']="NOT ENOUGH PRODUCT IN SALE STOCK ";
                            header("location:{$_SERVER['HTTP_REFERER']}");
                        }
                        

                    }else{
                        $_SESSION['fail_msg']="THIS PRODUCT IS NOT PRESENT IN SALES STOCK ";
                        header("location:{$_SERVER['HTTP_REFERER']}");
                    }



                    



                }else{
                    $_SESSION['fail_msg']="FIRST ENTER THE QUANTITY OF THE PRODUCT GREATER THAN ZERO";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                }
        
        }else{
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break;
    case "fetchOrder":
            $orderObj->setORef($_GET['o_ref']);
            $orderInfo = $orderDaoObj->selectOrderById($orderObj);
            $orderDetails->setOId($orderInfo['O_ID']);
            $results = $orderDetailsDao->selectOrderDetailsByOId( $orderDetails);
            array_push($productData,$results);
            echo json_encode($productData);
        break;    
    default:
        // header('location:../../');
        // session_destroy();    
        break;      
}

header("content-type:application/json");
?>