<?php 
session_start(); 
require_once"../MODEL/ordersModel.php";
require_once"../MODEL/productsModel.php";
require_once"../MODEL/priceModel.php";
require_once"../MODEL/salesStockModel.php";
require_once"../MODEL/orderDetailsModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";



$order = new ordersModel();
$price = new priceModel();
$product = new productsModel();
$orderDetails = new orderDetailsModel(); 
$salesStock = new salesStockModel();
$metric = new metricModel();
$users = new usersModel();

$action = $_GET['action'];
$data = [];

switch ($action) {
 	case 'insert':
        
        if (isset($_POST['PlaceOrder'])) {
         
            
         
            $o_reference = $_GET['o_ref'];
            $p_code = $_POST['p_code'];
            
            $products =  $product->selectCode($p_code);
            $p_id = $products['p_id'];
            $pd_id = $products['pd_id'];

            $od_quantity = $_POST['od_quantity'];
            $prices = $price->selectOne($p_id);
            $orders = $order->selectOref($o_reference);
            $orderdate = $orders['o_date'];
            $p_price = $prices['purchase_price'];
            $s_Nprice = $prices['price_normal'];
            $s_Vprice = $prices['price_vip'];
            $p_name = $prices['p_name'];

            if (!empty($o_reference)) {
              
               echo $o_reference;
               echo"<br>";
               print_r($prices); 

               echo"<br>";
               echo $prices['price_normal']; 

               echo"<br>";
               echo $prices['purchase_price']; 

               echo"<br>";
               echo $prices['price_vip']; 
               echo"<br>";
               print_r($orders);
               echo"<br>";
               print_r($orders['sub_type']);
               echo"<br>";
               print_r($orders['sub_reference']);
                
                if ($orders['sub_type']=="NORMAL") {
                    
                    if (($orderDetails->checkorderExist($o_reference,$p_id))===0) {

                        $Sales = $salesStock->selectOne($p_id);
                        $productQty = $Sales['stb_quantity'];
                       

                        if (($productQty > 0) && ($productQty >= $od_quantity)) {
                            $updateSales = $productQty - $od_quantity;
                            $salesStock->updateS($updateSales,$p_id);


                             $orderDetails->insert($o_reference,$p_id,$pd_id,$od_quantity,$p_price,$s_Nprice,$orderdate);


                            $e_id =  $_SESSION['logged_user']['e_id'];
                            $m_action = "$od_quantity  $p_name ORDERED ON $o_reference ";
                            $m_hour = date("H:i:s");
                            $m_day = date("l");
                            $m_date = date("Y-m-d");
                            $metric->insert($e_id,$m_action,$m_day,$m_date);
                            
                            // $_SESSION['success_msg'] = " $p_name IS PLACED ON AN ORDER WITH $o_reference  SUCCESSFULLY !!!";

                            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");


                        }else{

                            $_SESSION['fail_msg'] = "REMAIN (OR NOT ENOUGH)  $productQty PRODUCT(S) OF $p_name  IN STOCK  "; 
            
                            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");


                        }
                
                       



                    }else{
                         $Sales = $salesStock->selectOne($p_id);
                         $productQty = $Sales['stb_quantity'];

                        if (($productQty > 0) && ($productQty >= $od_quantity)) {
                            $updateSales = $productQty - $od_quantity;
                            $salesStock->updateS($updateSales,$p_id);


                        $odproduct = $orderDetails->selectProduct($o_reference,$p_id);
                        $updateQuantity = $odproduct['od_quantity'] + $od_quantity;
                        $orderDetails->updateQty($updateQuantity ,$o_reference,$p_id);
                        // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");

                        $e_id =  $_SESSION['logged_user']['e_id'];
                            $m_action = "$updateQuantity   $p_name ADDED ON $o_reference ";
                            $m_hour = date("H:i:s");
                            $m_day = date("l");
                            $m_date = date("Y-m-d");
                            $metric->insert($e_id,$m_action,$m_day,$m_date);


                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");


                        }else {
                            $_SESSION['fail_msg'] = "REMAIN (OR NOT ENOUGH)  $productQty PRODUCT(S) OF $p_name  IN STOCK  "; 
            
                            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");

                        }


                        
                    } 
                    
                } elseif ($orders['sub_type']=="VIP") {
                   

                    if (($orderDetails->checkorderExist($o_reference,$p_id))===0) {

                        $Sales = $salesStock->selectOne($p_id);
                        $productQty = $Sales['stb_quantity'];
                        
                        if (($productQty > 0) && ($productQty >= $od_quantity)) {
                            $updateSales = $productQty - $od_quantity;
                            $salesStock->updateS($updateSales,$p_id);

                            $orderDetails->insert($o_reference,$p_id,$pd_id,$od_quantity,$p_price,$s_Vprice,$orderdate);


                            $e_id =  $_SESSION['logged_user']['e_id'];
                            $m_action = " $od_quantity $p_name ORDERED ON $o_reference";
                            $m_hour = date("H:i:s");
                            $m_day = date("l");
                            $m_date = date("Y-m-d");
                            $metric->insert($e_id,$m_action,$m_day,$m_date);
                            
                            // $_SESSION['success_msg'] = " $p_name IS PLACED ON AN ORDER WITH $o_reference  SUCCESSFULLY !!!";

                            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");


                        } else {
                            $_SESSION['fail_msg'] = "REMAIN (OR NOT ENOUGH)  $productQty PRODUCT(S) OF $p_name  IN STOCK  "; 
            
                            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");

                        }
                        
                
                        



                    }else{
                         $Sales = $salesStock->selectOne($p_id);
                         $productQty = $Sales['stb_quantity'];

                       if (($productQty > 0) && ($productQty >= $od_quantity)) {
                            $updateSales = $productQty - $od_quantity;
                            $salesStock->updateS($updateSales,$p_id);


                        $odproduct = $orderDetails->selectProduct($o_reference,$p_id);
                        $updateQuantity = $odproduct['od_quantity'] + $od_quantity;
                        $orderDetails->updateQty($updateQuantity ,$o_reference,$p_id);

                         $e_id =  $_SESSION['logged_user']['e_id'];
                            $m_action = " $updateQuantity $p_name ADDED ON $o_reference";
                            $m_hour = date("H:i:s");
                            $m_day = date("l");
                            $m_date = date("Y-m-d");
                            $metric->insert($e_id,$m_action,$m_day,$m_date);




                        // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");


                        }else {
                            $_SESSION['fail_msg'] = "REMAIN (OR NOT ENOUGH)  $productQty PRODUCT(S) OF $p_name  IN STOCK  "; 
            
                            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");

                        }

                    } 


                }else {
                   

                       $_SESSION['fail_msg'] = "FAILED TO CREATE ORDER !!!"; 
            
                    // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");



                } 
                 
                


            }
               
            
            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");
                $users->directLink("SESSIONS/SUBSESSIONS/orderDetails.php?o_ref=$o_reference");


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