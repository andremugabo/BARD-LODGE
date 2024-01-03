<?php 
session_start();
require_once"../MODEL/stockModel.php";
require_once"../MODEL/productsModel.php";
require_once"../MODEL/priceModel.php";
require_once"../MODEL/purchaseModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";
require_once"../MODEL/sessionsModel.php";

$stock = new stockModel();
$product = new productsModel();
$prices = new priceModel();
$purchases = new purchaseModel();
$metric = new metricModel();
$users = new usersModel();
$sessions = new sessionsModel(); 

$action = $_GET['action'];
$data = [];

switch ($action) {
 	case 'insert':
        
        if (isset($_POST['addStock'])) {
         
            
            $e_id = $_SESSION['logged_user']['e_id'];
            $sub_id = $_GET['sub_id'];
            $p_id = $_POST['p_id'];
            $st_quantity = $_POST['st_quantity'];

            $price = $prices->selectOne($p_id);
            $p_price = $price['purchase_price'];
            $pex_amount = $st_quantity * $p_price;
            $session = $sessions->selectOpen();
            $sessionDate = $session['s_date'];

            if (!empty($e_id) && !empty($p_id) && !empty($sub_id)) {

                // if ($purchases->checkPurchaseExist($sub_id,$p_id,$p_price) == 0 ) {
                    $purchases->insert($sub_id,$e_id,$p_id,$p_price,$st_quantity,$pex_amount,$sessionDate);
                // } else {
                //     $purchase = $purchases->selectOneProduct($sub_id,$p_id,$p_price);
                //     $presentQty = $purchase['pex_qty'];
                //     $newQty = $presentQty + $st_quantity;
                //     $newAmount = $newQty * $p_price;

                //     $purchases->updateAmount($newQty,$newAmount,$sub_id,$p_id);
                // }
                

                if ($stock->checkIfproductExist($p_id) === 0) {
                
                $stock->insert($e_id,$sub_id,$p_id,$st_quantity);

                $productArray = $product->selectOne($p_id);
                $productName = $productArray['p_name'];
                // echo "hello".$productName;

                $employee_id = $_SESSION['logged_user']['e_id'];
                $e_id = $employee_id;
                $m_action = "$productName PURCHASED ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "$productName PURCGASED SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/stock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/stock.php");




            }elseif ($stock->checkIfproductExist($p_id) === 1) {
                
                $productArray = $stock->selectOne($p_id);
                $productName = $productArray['p_name'];
                $productQty = $productArray['st_quantity'];
                // print_r($productArray) ;
                $updateqty = $productQty + $st_quantity;

                $stock->update($e_id,$sub_id,$updateqty,$p_id);


                $employee_id = $_SESSION['logged_user']['e_id'];
                $e_id = $employee_id;
                $m_action = "$productName UPGRADED ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "$productName UPGRADED SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/stock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/stock.php");


            }
              
              


            }

            // $_SESSION['fail_msg'] = " FAILS !!!"; 
            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/stock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/stock.php");


            }
 		

 		
 		
 		break;
 	case 'edit':
        
        if(isset($_POST['editPStock'])){
            $p_id = $_POST['p_id'];
            $st_quantity = $_POST['st_quantity'];
            

            if(!empty($p_id) && !empty($st_quantity)){
               
                $stock->updateS($st_quantity,$p_id);
                $productArray = $stock->selectOne($p_id);
                $productName = $productArray['p_name'];

                        $_SESSION['success_msg'] = "$productName EDITED SUCCESSFULLY !!!";

                    
                    $employee_id = $_SESSION['logged_user']['e_id'];
                    $e_id = $employee_id;
                    $m_action = " EDITED $productName INFORMATION";
                    $m_hour = date("H:i:s");
                    $m_day = date("l");
                    $m_date = date("Y-m-d");
                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                    // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/stock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/stock.php");

            }
        }
        

         break;
 	default:
 		// code...
 		break;
 } 





 ?>