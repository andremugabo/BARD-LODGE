<?php
session_start();
require_once '../DAO/SStockDao.php';
require_once '../DAO/ReceivedProductsDao.php';
require_once '../DAO/MetricDao.php';

$action = $_GET['action'];
$SStockDaoObj = new SStockDao();
$SStockObj = new SStock();
$receivedDao = new ReceivedProductsDao();
$received = new ReceivedProducts();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action){
    case 'insert':
        if(isset($_POST['addProductIS'])){
            if(!empty($_POST['p_id'])){
                $SStockObj->setPId($_POST['p_id']);
                
                //to review
                $SStockObj->setSId($_SESSION['currentSession']);

                $feedback = $SStockDaoObj->checkIfProductExistSStock($SStockObj);
                // echo $feedback;
                if($feedback === 0){
                    //insert 
                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = " PRODUCT INSERTED INTO SALES STOCK  ";
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
                    $_SESSION['success_msg'] =" PRODUCT INSERTED INTO SALES STOCK  SUCCESSFULLY!!!";
                    $metricDaoObj->createMetric($metricObj);
                    $SStockDaoObj->createSStock($SStockObj);
                    header("location:{$_SERVER['HTTP_REFERER']}");
                    
                }else{
                    $_SESSION['fail_msg']="  PRODUCT EXIST  TO UPDATE QUANTITY ";
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
                        $SStockObj->setPId($_POST['p_id']);
                        $SStockObj->setPQty($_POST['qty']);
                        //insert 
                        $metricObj->setEId($_SESSION['logged']['E_ID']);
                        $mDesc = " PRODUCT QUANTITY UPDATED IN SALES STOCK  ";
                        $metricObj->setMDesc($mDesc);
                        //update product qty
                        $currentQty = $SStockDaoObj->selectProductQty($SStockObj);
                        $newQuantity = $currentQty['p_qty'] + $_POST['qty'];
                        $SStockObj->setPQty($newQuantity);


                        //to review after sessions(Done)
                        if(isset($_SESSION['currentSession']))
                        {
                            $metricObj->setSId($_SESSION['currentSession']);
                        }
                        else
                        {
                            $metricObj->setSId(null);
                        }
                        $received->setPId($_POST['p_id']);
                        $received->setSId($_SESSION['currentSession']);

                        //is the product exist in the current session?
                        $feedback = $receivedDao->checkIfProductExistInSession($received);
                        // echo $feedback;
                        if($feedback === 0){
                            //first time in received
                        $received->setQtyRec($_POST['qty']);
                        $_SESSION['success_msg'] ="PRODUCT QUANTITY UPDATED IN SALES STOCK SUCCESSFULLY!!!";
                        $metricDaoObj->createMetric($metricObj);
                        $SStockDaoObj->updateProductQty($SStockObj);
                        $receivedDao->createReceived($received);
                        header("location:../../PAGES/STOCKS/SStock.php");

                        }else{
                            //update received
                            
                            $currentQtyInreceived = $receivedDao->selectProductQty($received);
                            // echo "update received";
                            // echo "<br>";
                            print_r($currentQtyInreceived);
                            $newQtyInreceived = $currentQtyInreceived['qty_pur'] + $_POST['qty'];
                            // echo "<br>";
                            // echo $newQtyInreceived;
                            $received->setQtyRec($newQtyInreceived);
                            $_SESSION['success_msg'] ="PRODUCT QUANTITY UPDATED IN SALES STOCK SUCCESSFULLY!!!";
                            $metricDaoObj->createMetric($metricObj);
                            $SStockDaoObj->updateProductQty($SStockObj);
                            $receivedDao->updateProductQty($received);
                            header("location:../../PAGES/STOCKS/SStock.php");

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

        
            


            default:
            header('location:../../');
            session_destroy();    
            break;    
}

?>