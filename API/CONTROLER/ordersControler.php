<?php 
session_start();
require_once"../MODEL/ordersModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";
require_once"../MODEL/sessionsModel.php";


$order = new ordersModel();
$metric = new metricModel();
$users = new usersModel();
$sessions = new sessionsModel();

$action = $_GET['action'];
$data = [];

switch ($action) {
 	case 'insert':
        
        if (isset($_POST['CreateOrder'])) {
         
         
            $sub_id = $_GET['sub_id'];
            

           

            if (!empty($sub_id)) {

                $count = $order->countOrder();
                $countOrder = $count + 1;
                
                if ($countOrder < 10) {
                    $o_reference = "O"."-"."000".$countOrder;
                } elseif (($countOrder >= 10) && ($countOrder < 100 ) ) {
                    $o_reference = "O"."-"."00".$countOrder;
                }elseif(($countOrder >= 100) && ($countOrder < 1000 )) {
                    $o_reference = "O"."-"."0".$countOrder;
                }else{
                    $o_reference = "O"."-".$countOrder;
                }
                
                //  echo $o_reference;

                if (($order->checkorderExist($o_reference))===0) {
                
                $e_id =  $_SESSION['logged_user']['e_id'];
                $session = $sessions->selectOpen();
                $sessionDate = $session['s_date'];

                $order->insert($sub_id,$o_reference,$e_id,$sessionDate);

                $m_action = "$o_reference CREATED";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "$o_reference CREATED SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orders.php");
                $users->directLink("SESSIONS/SUBSESSIONS/orders.php");




            }else{
               $_SESSION['fail_msg'] = "$o_reference ALLREADY EXISTS !!!"; 
            //    header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orders.php");
                $users->directLink("SESSIONS/SUBSESSIONS/orders.php");

            } 


            }
            //    $_SESSION['fail_msg'] = "FAILED TO CREATE ORDER !!!"; 
            
            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/orders.php");
                $users->directLink("SESSIONS/SUBSESSIONS/orders.php");


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