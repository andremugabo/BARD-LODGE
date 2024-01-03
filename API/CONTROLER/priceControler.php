<?php 
session_start();
require_once"../MODEL/priceModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";


$Price = new priceModel();
$metric = new metricModel();
$users = new usersModel();

$action = $_GET['action'];
$data = [];



switch ($action) {
	case 'insert':
        if (isset($_POST['addPrice'])) {
            
                        $p_id = $_POST['p_id'];
                        $purchase_price = $_POST['purchase_price'];
                        $price_normal = $_POST['price_normal'];
                        $price_vip = $_POST['price_vip'];

                        


                        if (!empty($p_id) && !empty($price_normal) && !empty($price_vip)) {
                            if ($Price->checkIfExist($p_id)==0) {
                                
                                $Price->insert($p_id,$purchase_price,$price_normal,$price_vip);

                                

                                $_SESSION['success_msg'] = " PRICE ENTERED SUCCESSFULLY !!!";

                                    
                                    $employee_id = $_SESSION['logged_user']['e_id'];
                                    $e_id = $employee_id;
                                    $m_action = "  PRICES ENTERED  ";
                                    $m_hour = date("H:i:s");
                                    $m_day = date("l");
                                    $m_date = date("Y-m-d");
                                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                                    // header("location:../../USERS/MD/PRODUCTS/price.php");
                $users->directLink("PRODUCTS/price.php");


                                
                            } else {
                                $_SESSION['fail_msg'] = " PRICE ALLREADY EXIST !!!";
                                // header("location:../../USERS/MD/PRODUCTS/price.php");
                $users->directLink("PRODUCTS/price.php");

                                
                            }
                            
                        }

        }
		
		break;
	case 'edit':
        
        if (isset($_POST['editPrice'])) {
            
                        $p_id = $_POST['p_id'];
                        $purchase_price = $_POST['purchase_price'];
                        $price_normal = $_POST['price_normal'];
                        $price_vip = $_POST['price_vip'];

                        


                        if (!empty($p_id) && !empty($price_normal) && !empty($price_vip)) {
                            if ($Price->checkIfExist($p_id)==1) {
                                
                                $Price->update($p_id); 

                                if ($Price->checkIfExist($p_id)==0) {
                                    
                                    $Price->insert($p_id,$purchase_price,$price_normal,$price_vip);

                                

                                $_SESSION['success_msg'] = " PRICE EDITED SUCCESSFULLY !!!";

                                    
                                    $employee_id = $_SESSION['logged_user']['e_id'];
                                    $e_id = $employee_id;
                                    $m_action = "  PRICES EDITED  ";
                                    $m_hour = date("H:i:s");
                                    $m_day = date("l");
                                    $m_date = date("Y-m-d");
                                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                                    // header("location:../../USERS/MD/PRODUCTS/price.php");
                $users->directLink("PRODUCTS/price.php");


                                }else {
                                $_SESSION['fail_msg'] = " PRICE ALLREADY EXIST !!!";
                                // header("location:../../USERS/MD/PRODUCTS/price.php");
                $users->directLink("PRODUCTS/price.php");

                                
                            }

                                

                                
                            } 
                            
                        }

        }

        break;
	default:
		// code...
		break;
}






 ?>