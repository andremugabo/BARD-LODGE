<?php
session_start();
require_once '../DAO/GStockDao.php';
require_once '../DAO/PurchaseProductsDao.php';
require_once '../DAO/PricesDao.php';
require_once '../DAO/MetricDao.php';

$action = $_GET['action'];
$gStockDaoObj = new GStockDao();
$gStockObj = new GStock();
$purchaseDao = new PurchaseProductsDao();
$purchase = new PurchaseProducts();
$priceDao = new PricesDao();
$price = new Price();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action){
    case 'insert':
        if(isset($_POST['addProductIS'])){
            if(!empty($_POST['p_id'])){
                $gStockObj->setPId($_POST['p_id']);
                
                //to review
                $gStockObj->setSId($_SESSION['currentSession']);

                $feedback = $gStockDaoObj->checkIfProductExistGStock($gStockObj);
                // echo $feedback;
                if($feedback === 0){
                    //insert 
                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = " PRODUCT INSERTED INTO STOCK  ";
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
                    $_SESSION['success_msg'] =" PRODUCT INSERTED INTO STOCK  SUCCESSFULLY!!!";
                    $metricDaoObj->createMetric($metricObj);
                    $gStockDaoObj->createGStock($gStockObj);
                    header("location:{$_SERVER['HTTP_REFERER']}");
                    
                }else{
                    $_SESSION['fail_msg']="  PRODUCT EXIST PURCHASE TO UPDATE QUANTITY ";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                }


            }else{
                $_SESSION['fail_msg']="FILL OUT ALL  TEXT FIELD !!";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
            

        }else{
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        
        break;
        case 'updateQ':
            if(isset($_POST['updateQty'])){
                
                if(!empty($_POST['p_id']) && !empty($_POST['qty'])){
                    if($_POST['qty'] > 0){
                        $gStockObj->setPId($_POST['p_id']);
                        // $gStockObj->setPQty($_POST['qty']);
                        //insert 
                        $metricObj->setEId($_SESSION['logged']['E_ID']);
                        $mDesc = " PRODUCT QUANTITY UPDATED IN G STOCK  ";
                        $metricObj->setMDesc($mDesc);
                        //update product qty
                        $currentQty = $gStockDaoObj->selectProductQty($gStockObj);
                        $newQuantity = $currentQty['p_qty'] + $_POST['qty'];
                        $gStockObj->setPQty($newQuantity);
                        $price->setPId($_POST['p_id']);
                        $price->setUnityId($_POST['unity_id']);
                        $purchase_price = $priceDao->selectPurchasePriceByPId($price);
                        if($purchase_price != null){
                                // print_r($purchase_price['pprice']);
                            $gStockObj->setPPrice($purchase_price['pprice']);


                            //to review after sessions(Done)
                            if(isset($_SESSION['currentSession']))
                            {
                                $metricObj->setSId($_SESSION['currentSession']);
                            }
                            else
                            {
                                $metricObj->setSId(null);
                            }
                            $purchase->setPId($_POST['p_id']);
                            $purchase->setSId($_SESSION['currentSession']);

                            //is the product exist in the current session?
                            $feedback = $purchaseDao->checkIfProductExistInSession($purchase);
                            // echo $feedback;
                            if($feedback === 0){
                                //first time in purchase
                            $purchase->setQtyPur($_POST['qty']);
                            $purchase->setPPrice($purchase_price['pprice']);
                            $_SESSION['success_msg'] ="PRODUCT QUANTITY UPDATED IN G STOCK SUCCESSFULLY!!!";
                            $metricDaoObj->createMetric($metricObj);
                            $gStockDaoObj->updateProductQty($gStockObj);
                            $purchaseDao->createPurchase($purchase);
                            header("location:../../PAGES/STOCKS/gStock.php");

                            }else{
                                //update purchase
                                
                                $currentQtyInPurchase = $purchaseDao->selectProductQty($purchase);
                                // echo "update purchase";
                                // echo "<br>";
                                // print_r($currentQtyInPurchase);
                                $newQtyInPurchase = $currentQtyInPurchase['qty_pur'] + $_POST['qty'];
                                // echo "<br>";
                                // echo $newQtyInPurchase;
                                $purchase->setQtyPur($newQtyInPurchase);

                                $_SESSION['success_msg'] ="PRODUCT QUANTITY UPDATED IN G STOCK SUCCESSFULLY!!!";
                                $metricDaoObj->createMetric($metricObj);
                                $gStockDaoObj->updateProductQty($gStockObj);
                                $purchaseDao->updateProductQty($purchase);
                                header("location:../../PAGES/STOCKS/gStock.php");

                            }
                        }else{
                            $_SESSION['fail_msg']="THAT PRODUCT DOES NOT HAVE A PRICE";
                            header("location:{$_SERVER['HTTP_REFERER']}"); 
                        }
                        

                        
                    }else{
                        $_SESSION['fail_msg']="QUANTITY SHOULD BE GREATER THAN ZERO !!";
                        header("location:{$_SERVER['HTTP_REFERER']}"); 
                    }
                   
                }else{
                    $_SESSION['fail_msg']="FILL OUT ALL  TEXT FIELD !!";
                    header("location:{$_SERVER['HTTP_REFERER']}"); 
                }
            }
        else{
            header("location:{$_SERVER['HTTP_REFERER']}");
            }
            
            break;
        case 'changeQ':
            if(isset($_POST['changeQty'])){
                if(!empty($_POST['p_id']) && !empty($_POST['change_qty'])){
                   $gStockObj->setPId($_POST['p_id']);
                   $gStockObj->setPQty($_POST['change_qty']);
                   $gStockDaoObj->changeProductQty($gStockObj);


                   $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = " CHANGE THE PRODUCT QUANTITY IN GSTOCK";
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
                            $_SESSION['success_msg'] = "PRODUCT QUANTITY CHANGED SUCCESSFULLY";
                            $result = $metricDaoObj->createMetric($metricObj);
                            header("location:../../PAGES/STOCKS/gStock.php");

                }else{
                    $_SESSION['fail_msg']="FILL OUT ALL  TEXT FIELD !!";
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