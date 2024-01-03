<?php 
session_start();
require_once"../MODEL/productsModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";

$products = new productsModel();
$metric = new metricModel();
$users = new usersModel();
$action = $_GET['action'];
$data = [];

switch ($action) {
 	case 'insert':
        
        if (isset($_POST['addProduct'])) {
         
         
            $pd_id = $_POST['pd_id'];
            $cat_id = $_POST['cat_id'];
            $p_name = strtoupper($_POST['p_name']);
            $p_brand = strtoupper($_POST['p_brand']);

           

            if (!empty($cat_id) && !empty($p_name) && !empty($p_brand)) {

                if ($products->checkIfproductExist($cat_id,$p_name,$p_brand) === 0) {
                
                $count = $products->countProducts();
                $countProduct =$count + 1;

                    if ($countProduct < 10) {
                        $p_code = "00".$countProduct;
                    } elseif(($countProduct >= 10) && ($countProduct < 100 )) {
                        $p_code = "0".$countProduct;
                    }else{
                        $p_code = $countProduct;
                    }
                    
                
                    $products->insert($pd_id,$cat_id,$p_code,$p_name,$p_brand);

                $employee_id = $_SESSION['logged_user']['e_id'];
                $e_id = $employee_id;
                $m_action = "$p_name REGISTERED ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "$p_name REGISTERED SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/PRODUCTS/");
                $users->directLink("PRODUCTS/");




            }else{
               $_SESSION['fail_msg'] = "$p_name ALLREADY REGISTERED !!!"; 
            //    header("location:../../USERS/MD/PRODUCTS/");
                $users->directLink("PRODUCTS/");

            } 


            }

            // header("location:../../USERS/MD/PRODUCTS/");
                $users->directLink("PRODUCTS/");


            }
 		

 		
 		
 		break;
 	case 'edit':
        
        if(isset($_POST['editProduct'])){
            $p_id = $_POST['p_id'];
            $pd_id = $_POST['pd_id'];
            $cat_id = $_POST['cat_id'];
            $p_name = strtoupper($_POST['p_name']);
            $p_brand = strtoupper($_POST['p_brand']);

            if(!empty($pd_id) && !empty($p_name) && !empty($p_brand) && !empty($p_id)){
               
                $products->edit($pd_id,$cat_id,$p_name,$p_brand,$p_id);

                        $_SESSION['success_msg'] = "$p_name EDITED SUCCESSFULLY !!!";

                    
                    $employee_id = $_SESSION['logged_user']['e_id'];
                    $e_id = $employee_id;
                    $m_action = " EDITED $p_name INFORMATION";
                    $m_hour = date("H:i:s");
                    $m_day = date("l");
                    $m_date = date("Y-m-d");
                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                    // header("location:../../USERS/MD/PRODUCTS/");
                $users->directLink("PRODUCTS/");

            }
        }
        

         break;
 	default:
 		// code...
 		break;
 } 





 ?>