<?php 
session_start();
require_once"../MODEL/ordersModel.php";
require_once"../MODEL/productsModel.php";
require_once"../MODEL/priceModel.php";
require_once"../MODEL/salesStockModel.php";
require_once"../MODEL/orderDetailsModel.php";
require_once"../MODEL/voidOrderModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";

$order = new ordersModel();
$price = new priceModel();
$product = new productsModel();
$orderDetails = new orderDetailsModel();
$salesStock = new salesStockModel();
$voidOrder = new voidOrderModel();
$metric = new metricModel();
$users = new usersModel();
$action = $_GET['action'];
$data = [];

switch ($action) {
 	case 'insert':
        
        if (isset($_POST['VoidOrder'])) {
         
         
            $o_reference = $_GET['o_ref'];
            // $p_id = $_POST['p_id'];
            $p_code = $_POST['p_code'];
            
            $products =  $product->selectCode($p_code);
            $p_id = $products['p_id'];

            $od_quantity = $_POST['od_quantity'];
            $orderDetail = $orderDetails->selectProduct($o_reference,$p_id);
            $salesStockProduct = $salesStock->selectOne($p_id);
            $orderDetailsQty = $orderDetail['od_quantity'];
            $salesStockQty = $salesStockProduct['stb_quantity'];
            $p_name = $salesStockProduct['p_name'];
            

            $e_id =  $_SESSION['logged_user']['e_id'];
           

            if (($orderDetailsQty > 0) && ($od_quantity <= $orderDetailsQty)) {
                $updateOrderDetails = $orderDetailsQty - $od_quantity;
                $updateSalesStock = $salesStockQty +  $od_quantity;
                $orderDetails->updateQty($updateOrderDetails,$o_reference,$p_id);
                $salesStock->updateS($updateSalesStock,$p_id);

                if ($voidOrder->checkProductExist($o_reference,$p_id)=== 0) {
                    $voidOrder->insert($o_reference,$e_id,$p_id,$od_quantity);

                    if ($updateOrderDetails == 0) {
                        $orderDetails->delete($o_reference,$p_id);
                    }

                } else {
                    $voidedProduct = $voidOrder->selectOne($o_reference,$p_id);
                    $updateVoideQty = $voidedProduct['vo_quantity'] + $od_quantity;
                    $voidOrder->updateQty($updateVoideQty,$o_reference,$p_id);

                    if ($updateOrderDetails == 0) {
                        $orderDetails->delete($o_reference,$p_id);
                    }

                }
                 
                
                
                $m_action = " VOIDED $od_quantity  $p_name  ON AN ORDER  WITH  REFERENCE $o_reference ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "VOIDED $od_quantity  $p_name  ON AN ORDER  WITH  REFERENCE $o_reference SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/voidOrder.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/voidOrder.php?o_ref=$o_reference");



            } 
            
                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/voidOrder.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/voidOrder.php?o_ref=$o_reference");

            

        }  

 		
 		
 		break;
 	case 'edit':
        
        // if(isset($_POST['editProduct'])){
        //     $p_id = $_POST['p_id'];
        //     $pd_id = $_POST['pd_id'];
        //     $cat_id = $_POST['cat_id'];
        //     $p_name = strtoupper($_POST['p_name']);
        //     $p_brand = strtoupper($_POST['p_brand']);

        //     if(!empty($pd_id) && !empty($p_name) && !empty($p_brand) && !empty($p_id)){
               
        //         $products->edit($pd_id,$cat_id,$p_name,$p_brand,$p_id);

        //                 $_SESSION['success_msg'] = "$p_name EDITED SUCCESSFULLY !!!";

                    
        //             $employee_id = $_SESSION['logged_user']['e_id'];
        //             $e_id = $employee_id;
        //             $m_action = " EDITED $p_name INFORMATION";
        //             $m_hour = date("H:i:s");
        //             $m_day = date("l");
        //             $m_date = date("Y-m-d");
        //             $metric->insert($e_id,$m_action,$m_day,$m_date);
        //             header("location:../../USERS/MD/PRODUCTS/");
        //     }
        // }
        

         break;
 	default:
 		// code...
 		break;
 } 





 ?>