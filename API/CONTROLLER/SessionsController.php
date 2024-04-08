<?php
session_start();
require_once '../DAO/SessionsDao.php';
require_once '../DAO/GStockDao.php';
require_once '../DAO/SStockDao.php';
require_once '../DAO/Closing_general_stockDao.php';
require_once '../DAO/Closing_sales_reportDao.php';
require_once '../DAO/Closing_sales_stockDao.php';
require_once '../DAO/OrderDetailsDao.php';
require_once '../DAO/OrdersDao.php';
require_once '../DAO/MetricDao.php';


$action = $_GET['action'];
$sessionObj = new Sessions();
$sessionDaoObj = new SessionsDao();
$gStockDaoObj = new GStockDao();
$gStockObj = new GStock();
$SStockDaoObj = new SStockDao();
$SStockObj = new SStock();
$orderDetailsDao = new OrderDetailsDao();
$orderDetails = new OrderDetails();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$orderDao = new OrdersDao();
$orderObj = new Orders();

$cgStockObj = new Closing_general_stock();
$cgStockDao = new Closing_general_stockDao();
$csStockObj = new Closing_sales_stock();
$csStockDao = new Closing_sales_stockDao();
$csReportObj = new Closing_sales_report();
$csReportDao = new Closing_sales_reportDao();


switch($action){
    case 'insert':
        if(isset($_POST['addSession']))
        {
            $feedback = $sessionDaoObj->checkOpenSessions();
            // echo $feedback;
            if($feedback === 0)
            {
                $count = $sessionDaoObj->countSessions() + 1;
                // echo $count;
                $date = date('D/d-M-Y');
                // echo $date;
                if($count < 10 )
                {
                    $s_ref = "SESSION-".$date."-000".$count;
                }
                else if($count >= 10 && $count < 100)
                {
                    $s_ref = "SESSION-".$date."-00".$count;
                }
                else if($count >= 100 && $count < 1000)
                {
                    $s_ref = "SESSION-".$date."-0".$count;
                }
                else
                {
                    $s_ref = "SESSION-".$date."-".$count;
                }
                // echo $s_ref;
                if(!empty($s_ref))
                {
                    //create metric 
                //set user id for metric 
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " CREATED A SESSION ".$s_ref;
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
                $_SESSION['success_msg'] = $s_ref." CREATED SUCCESSFULLY!!!";
                $sessionObj->setSRef($s_ref);
                $sessionDaoObj->createSession($sessionObj);
                $metricDaoObj->createMetric($metricObj);

                header('location:../../');
                session_destroy();  
                }
                else
                {
                    $_SESSION['fail_msg']="FAILED TO CREATE SESSION !!";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                }

            }
            else
            {
                $_SESSION['fail_msg']="THERE IS AN OPEN SESSION !!";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }

        }
        else
        {
            $_SESSION['fail_msg']="YOU ARE NOT AUTHORIZED TO CREATE A SESSION";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break;
    case 'close':
        if(isset($_POST['closeSession'])){
            if(!empty($_POST['s_ref'])){
                $s_id = $_POST['s_id'];
                $s_ref = $_POST['s_ref'];


                $orderObj->setSId($s_id);
                $checkNotPaid = $orderDao->checkNotPaidOrderBySid($orderObj);

                if($checkNotPaid === 0){

                    /*=========================================================
                                        MAIN STOCK REPORT
                    ===========================================================*/ 
                // set s_id for general stock
                    $gStockObj->setSId($s_id);
                    // get general stock by s_id 
                    $generalStock = $gStockDaoObj->selectGeneralStockBySid();
                    if($generalStock != null):
                        foreach($generalStock as $items){
                            
                            // echo "<br>";
                            $cgStockObj->setSRef($s_ref);
                            $cgStockObj->setPId($items['P_ID']);
                            $cgStockObj->setPQty($items['P_QTY']);
                            $cgStockObj->setPPrice($items['P_PPRICE']);
                            $cgStockDao->createCGStock($cgStockObj);



                        }
                    endif;
                    // echo "<br>";
                    // echo "sales stock";
                    // echo "<br>";

                    /*===========================================================
                                        SALES STOCK REPORT
                    =============================================================*/ 
                    // set s_id for sales stock
                    $SStockObj->setSId($s_id);
                    // get sales stock by s_id
                    $saleStock = $SStockDaoObj->selectSStockBySid();
                    if($saleStock != null):
                        foreach($saleStock as $items){
                            // print_r($items);
                            // echo "<br>";
                            $csStockObj->setSRef($s_ref);
                            $csStockObj->setPId($items['P_ID']);
                            $csStockObj->setPQty($items['P_QTY']);
                            $csStockObj->setPPrice($items['P_PPRICE']);
                            $csStockDao->createCSStock($csStockObj);

                        }
                    endif;
                    // echo "<br>";
                    // echo "sales report";
                    // echo "<br>";
                    /*===========================================================
                                        SALES REPORT
                    =============================================================*/ 
                    //set s_id for sales report
                    $orderDetails->setSId($s_id);
                    //get sales report by s_id
                    $salesReport = $orderDetailsDao->selectProductUnityBySid($orderDetails);
                    if($salesReport != null):
                        foreach($salesReport as $items){
                        $orderDetails->setUnityId($items['unity_id']);
                        $orderDetails->setPId($items['p_id']);
                        //    get qty from order details
                        $getQty = $orderDetailsDao->selectQtyOfProductByUnityBySid($orderDetails);
                        if($getQty != null):
                            foreach($getQty as $key){
                                // print_r($key);
                                $csReportObj->setSRef($s_ref);
                                $csReportObj->setUnityId($key['unity_id']);
                                $csReportObj->setPId($key['p_id']);
                                $csReportObj->setPQty($key['total_quantity']);
                                $csReportObj->setPPrice($key['p_price']);
                                $csReportObj->setPSprice($key['s_price']);
                                $csReportDao->createSReport($csReportObj);

                            }
                        endif;
                        }
                    endif;
                    
                    // Closing session 
                    $sessionObj->setSId($s_id);
                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = "SESSION IS CLOSED ";
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
                    $_SESSION['success_msg'] ="SESSION CLOSED SUCCESSFULLY!!!";
                    $metricDaoObj->createMetric($metricObj);
                    $sessionDaoObj->closeSession($sessionObj);
                    header('location:../../');
                    session_destroy();  

                }else{
                    $_SESSION['fail_msg']="THERE IS AN ORDER WHICH IS NOT PAID ";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                }



               


                

            }
        }else{
             header('location:../../');
             session_destroy();  
        }
        
        break;
    default:
         
        break;     

    }








?>