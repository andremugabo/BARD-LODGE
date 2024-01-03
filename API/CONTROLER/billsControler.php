<?php  
session_start();
require_once"../MODEL/ordersModel.php";
require_once"../MODEL/orderDetailsModel.php";
require_once"../MODEL/billDetailsModel.php";
require_once"../MODEL/billsModel.php";
require_once"../MODEL/balanceModel.php";
require_once"../MODEL/sessionsModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";

$order = new ordersModel();
$orderDetails = new orderDetailsModel();
$billDetails = new billDetailsModel();
$bill = new billsModel();
$balance = new balanceModel();
$sessions = new sessionsModel();
$metric = new metricModel();
$users = new usersModel();
$action = $_GET['action'];
$data = [];

switch ($action) {
 	case 'insert':
        
        if (isset($_POST['CreateBill'])) {
         
         
            $o_reference = $_POST['o_reference'];
            
            if (!empty($o_reference)) {

                
                    
                
             $orders = $order->selectOref($o_reference);
             $sub_type = $orders['sub_type'];
             $waiter = $orders['e_names'];

                $count = $bill->countBill();
                $countBill = $count + 1;
                
                if ($countBill < 10) {
                    $b_reference = "INV"."-"."000".$countBill;
                } elseif (($countBill >= 10) && ($countBill < 100 ) ) {
                    $b_reference = "INV"."-"."00".$countBill;
                }elseif(($countBill >= 100) && ($countBill < 1000 )) {
                    $b_reference = "INV"."-"."0".$countBill;
                }else{
                    $b_reference = "INV"."-".$countBill;
                }
                
                //  echo $o_reference;

                if (($bill->checkbillExist($b_reference))===0 && ($bill->checkObillExist($o_reference))===0) {
                
                $e_id =  $_SESSION['logged_user']['e_id'];
                $payment_status = "NOT PAID";

                $session = $sessions->selectOpen();
                $sessionDate = $session['s_date'];

                $bill->insert($b_reference,$o_reference,$e_id,$waiter,$sub_type,$payment_status,$sessionDate);  
                //  echo $o_reference;
                if ($orderDetails->selectRef($o_reference)):    

                foreach ($orderDetails->selectRef($o_reference) as $key) {
                    print_r($key);
                    $p_id = $key['p_id'];
                    $pd_id = $key['pd_id'];
                    $bd_quantity = $key['od_quantity'];
                    $bd_bprice = $key['p_price'];
                    $bd_sprice = $key['s_price'];

                    $billDetails->insert($b_reference,$p_id,$pd_id,$bd_quantity,$bd_bprice,$bd_sprice,$sessionDate); 
                }


                endif;

                $m_action = "$b_reference CREATED";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "BILL WITH $b_reference REFERENCE IS CREATED SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/bills.php");
                $users->directLink("SESSIONS/SUBSESSIONS/bills.php");



            }else{
               $_SESSION['fail_msg'] = "BILL WITH $b_reference ALLREADY EXISTS !!!"; 
            //    header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/bills.php");
                $users->directLink("SESSIONS/SUBSESSIONS/bills.php");

            } 


            }
            //    $_SESSION['fail_msg'] = "FAILED TO CREATE ORDER !!!"; 
            
            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/bills.php");
                $users->directLink("SESSIONS/SUBSESSIONS/bills.php");


            }
 		

 		
 		
 		break;
 	case 'pay':
        
        if(isset($_POST['payBill'])){
            $o_reference = $_POST['o_reference'];
            $b_reference = $_POST['b_reference']; 
            // echo $_POST['payment_mode'];
            $waiter = $_POST['waiter'];
            $cashier = $_POST['cashier'];
            $b_amount = $_POST['b_amount'];
            $given_amount = $_POST['given_amount'];
            // $bl_payment = $_POST['bl_payment'];
            $payment_mode = $_POST['payment_mode'];
            $bl_amount = $_POST['bl_amount'];
          
            if(!empty($o_reference) && !empty($b_reference) && !empty($waiter) && !empty($cashier)){
                 

                if($given_amount >= $b_amount){

                $payment_status = "PAID";
                            
                                $bill->update($payment_mode,$payment_status,$b_amount,$b_reference);
                                if ($bl_amount > 0) {
                                $balance->insert($o_reference,$b_reference,$cashier,$waiter,$bl_amount);
                                }
                                
                                $order->updateAmount($payment_status,$b_amount,$o_reference);

                                        $_SESSION['success_msg'] = "BILL WITH REFERENCE $b_reference PAID SUCCESSFULY !!!";

                                    
                                    $employee_id = $_SESSION['logged_user']['e_id'];
                                    $e_id = $employee_id;
                                    $m_action = " BILL WITH REFERENCE $b_reference PAID SUCCESSFULY !!!";
                                    $m_hour = date("H:i:s");
                                    $m_day = date("l");
                                    $m_date = date("Y-m-d");
                                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                                    // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/bills.php");
                                $users->directLink("SESSIONS/SUBSESSIONS/bills.php");
                    
                }else{

                     $_SESSION['fail_msg'] = "THE GIVEN AMOUNT ON $b_reference IS NOT ENOUGH !!!";
                     $users->directLink("SESSIONS/SUBSESSIONS/bills.php");

                }
                

            }
        }
        

         break;
    case 'payBalance':
        if (isset($_GET['bl_id'])) {
            $bl_id = $_GET['bl_id'];

            $balance->updateCashier($bl_id);

             $_SESSION['success_msg'] = "BALANCE PAID SUCCESSFULY !!!";

                    
                    $employee_id = $_SESSION['logged_user']['e_id'];
                    $e_id = $employee_id;
                    $m_action = " BALANCE PAID ";
                    $m_hour = date("H:i:s");
                    $m_day = date("l");
                    $m_date = date("Y-m-d");
                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                    // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/balance.php");
                $users->directLink("SESSIONS/SUBSESSIONS/balance.php");


        }
        break;  
    case 'closeBalance':
        if (isset($_GET['bl_id'])) {
            $bl_id = $_GET['bl_id'];

            $balance->updateWaiter($bl_id);

             $_SESSION['success_msg'] = "BALANCE PAYMENT ACCEPTED SUCCESSFULY !!!";

                    
                    $employee_id = $_SESSION['logged_user']['e_id'];
                    $e_id = $employee_id;
                    $m_action = "BALANCE PAYMENT ACCEPTED ";
                    $m_hour = date("H:i:s");
                    $m_day = date("l");
                    $m_date = date("Y-m-d");
                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                    // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/balance.php");
                $users->directLink("SESSIONS/SUBSESSIONS/balance.php");


        }
        break;  
    case 'editBill':
         
        if (isset($_POST['editbill'])) {
            $b_reference = $_POST['b_reference'];
            $payment_mode = $_POST['payment_mode'];

            echo $payment_mode;
            $bill->editBill($b_reference,$payment_mode);
                
            
             $_SESSION['success_msg'] = "BILL $b_reference PAYMENT MODE UPDATED TO $payment_mode SUCCESSFULY !!!";

                    
                    $employee_id = $_SESSION['logged_user']['e_id'];
                    $e_id = $employee_id;
                    $m_action = "BILL $b_reference PAYMENT MODE UPDATED TO $payment_mode ";
                    $m_hour = date("H:i:s");
                    $m_day = date("l");
                    $m_date = date("Y-m-d");
                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                    // header("location:../../USERS/MD/SESSIONS/SUBS
            
            $users->directLink("REPORTS/credited.php");

        }

        break; 
 	default:
 		// code...
 		break;
 } 





 ?>