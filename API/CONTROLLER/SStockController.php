<?php
session_start();
require_once '../DAO/SStockDao.php';
require_once '../DAO/GStockDao.php';
require_once '../DAO/ReceivedProductsDao.php';
require_once '../DAO/MetricDao.php';

$action = $_GET['action'];
$SStockDaoObj = new SStockDao();
$GStockDaoObj = new GStockDao();
$SStockObj = new SStock();
$GStockObj = new GStock();
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
                // check if product exist in sales stock
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
                    $_SESSION['fail_msg']="  PRODUCT EXIST !! JUST  UPDATE QUANTITY ";
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
                        $metricObj->setEId($_SESSION['logged']['E_ID']);
                        $mDesc = " PRODUCT QUANTITY UPDATED IN SALES STOCK  ";
                        $metricObj->setMDesc($mDesc);
                        $SStockObj->setPId($_POST['p_id']);
                        // $SStockObj->setPQty($_POST['qty']);
                        //GET QUANTITY IN GENERAL STOCK
                        $GStockObj->setPId($_POST['p_id']);
                        $presentGeneralStockQty = $GStockDaoObj->selectProductQty($GStockObj);
                        // print_r($presentGeneralStockQty['p_qty']);
                        //CHECK THE ENTERED QUANTITY IS POSITIVE AND LESS THAN THE QUANTITY IN GENERAL STOCK
                        if($_POST['qty'] <= $presentGeneralStockQty['p_qty']){
                            //NEW QTY IN GENERAL STOCK
                            $newGeneralStockQty = $presentGeneralStockQty['p_qty'] - $_POST['qty'];
                            // $GStockObj->setPId($_POST['p_id']);
                            $GStockObj->setPQty($newGeneralStockQty);
                            //NEW QTY IN SALES STOCK
                            $SStockObj->setPId($_POST['p_id']);
                            $presentSalesStockQty = $SStockDaoObj->selectProductQty($SStockObj);
                            // print_r($presentSalesStockQty['p_qty']);
                            $newSalesStockQty = $presentSalesStockQty['p_qty'] + $_POST['qty'];
                            // $SStockObj->setPId($_POST['p_id']);
                            $SStockObj->setPQty($newSalesStockQty);
                            // echo $newGeneralStockQty;
                            //RECEIVED PRODUCT
                            $received->setPId($_POST['p_id']);
                            $received->setSId($_SESSION['currentSession']);

                            //is the product exist in the current session?
                            $feedback = $receivedDao->checkIfProductExistInSession($received);
                            echo $feedback;
                            if($feedback === 0){
                                //first time in received
                                $received->setQtyRec($_POST['qty']);
                                $_SESSION['success_msg'] ="PRODUCT QUANTITY UPDATED IN SALES STOCK SUCCESSFULLY!!!";
                                $metricDaoObj->createMetric($metricObj);
                                //UPDATE SALES STOCK
                                $SStockDaoObj->updateProductQty($SStockObj);
                                //UPDATE GENERAL STOCK
                                $GStockDaoObj->updateProductQty($GStockObj);
                                $receivedDao->createReceived($received);
                                header("location:../../PAGES/STOCKS/sStock.php");
                            }else{
                                $currentQtyInreceived = $receivedDao->selectProductQty($received);
                                // echo "update received";
                                // echo "<br>";
                                // print_r($currentQtyInreceived);
                                $newQtyInreceived = $currentQtyInreceived['qty_rec'] + $_POST['qty'];
                                // echo "<br>";
                                // echo $newQtyInreceived;
                                $received->setQtyRec($newQtyInreceived);
                                $_SESSION['success_msg'] ="PRODUCT QUANTITY UPDATED IN SALES STOCK SUCCESSFULLY!!!";
                                $metricDaoObj->createMetric($metricObj);
                                //UPDATE SALES STOCK
                                $SStockDaoObj->updateProductQty($SStockObj);
                                //UPDATE GENERAL STOCK
                                $GStockDaoObj->updateProductQty($GStockObj);
                                $receivedDao->updateProductQty($received);
                                header("location:../../PAGES/STOCKS/sStock.php");
                            }






                        }else{
                            $_SESSION['fail_msg']="NOT ENOUGH QUANTITY IN STOCK ONLY ".$presentGeneralStockQty['p_qty']." ITEMS";
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

        
            


            default:
            header('location:../../');
            session_destroy();    
            break;    
}

?>