<?php 
session_start();
require_once"../MODEL/stockModel.php";
require_once"../MODEL/salesStockModel.php";
require_once"../MODEL/productsModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";

$stock = new stockModel();
$salesStock = new salesStockModel();
$product = new productsModel();
$metric = new metricModel();
$users = new usersModel();
$action = $_GET['action'];
$data = [];

switch ($action) {
 	case 'insert':
        
        if (isset($_POST['addSales'])) {
         
            
            $e_id = $_SESSION['logged_user']['e_id'];
            $sub_id = $_GET['sub_id'];
            $p_id = $_POST['p_id'];
            $stb_quantity = $_POST['stb_quantity'];

           

            if (!empty($e_id) && !empty($p_id) && !empty($sub_id)) {

                if ($salesStock->checkIfproductExist($p_id) === 0) {
                
                    $productInStock = $stock->selectOne($p_id);
                    $productName = $productInStock['p_name'];
                    $productQty = $productInStock['st_quantity'];

                    if (($stock->checkIfproductExist($p_id) === 1) && ($productQty > 0 ) && ($productQty >= $stb_quantity)) {
                        
                        $updateqtyStock = $productQty - $stb_quantity;
                        $stock->updateS($updateqtyStock,$p_id);

                        $salesStock->insert($e_id,$sub_id,$p_id,$stb_quantity);

                        $productArray = $product->selectOne($p_id);
                        $productName = $productArray['p_name'];
                        // echo "hello".$productName;

                        $employee_id = $_SESSION['logged_user']['e_id'];
                        $e_id = $employee_id;
                        $m_action = "$productName REGISTERED IN SALES STOCK";
                        $m_hour = date("H:i:s");
                        $m_day = date("l");
                        $m_date = date("Y-m-d");
                        $metric->insert($e_id,$m_action,$m_day,$m_date);
                        
                        $_SESSION['success_msg'] = "$productName REGISTERED IN SALES STOCK SUCCESSFULLY !!!";

                        // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/salesStock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/salesStock.php");

                    }else{
                        $_SESSION['fail_msg'] = " THE PRODUCT IS OUT OF STOCK IN GENERAL STOCK"; 
                        // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/salesStock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/salesStock.php");

                    }

               



            }elseif ($salesStock->checkIfproductExist($p_id) === 1) {
                
                $productInStock = $stock->selectOne($p_id);
                $productName = $productInStock['p_name'];
                $productQty = $productInStock['st_quantity'];
                // print_r($productArray) ;
                if($productQty > 0 && ($productQty >= $stb_quantity)){

                    $updateqtyStock = $productQty - $stb_quantity;
                    $stock->updateS($updateqtyStock,$p_id);

                $productInBar = $salesStock->selectOne($p_id);
                $productQtyInBar = $productInBar['stb_quantity'];
                $updateBar = $productQtyInBar + $stb_quantity;
                $salesStock->update($e_id,$sub_id,$updateBar,$p_id);

                


                $employee_id = $_SESSION['logged_user']['e_id'];
                $e_id = $employee_id;
                $m_action = "$productName UPGRADED IN SALES STOCK ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "$productName UPGRADED IN SALES STOCK SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/salesStock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/salesStock.php");



                }else{
                     $productInStock = $stock->selectOne($p_id);
                     $productName = $productInStock['p_name'];
                     $productQty = $productInStock['st_quantity'];
                     $_SESSION['fail_msg'] = " NOT ENOUGH !! REMAIN $productName $productQty IN STOCK"; 
                }

                

            }
              
              


            }

            // $_SESSION['fail_msg'] = " FAILS !!!"; 
            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/salesStock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/salesStock.php");


            }
 		

 		
 		
 		break;
 	case 'edit':
        
        if(isset($_POST['editPSalesStock'])){
            $p_id = $_POST['p_id'];
            $stb_quantity = $_POST['stb_quantity'];
            

            if(!empty($p_id) && !empty($stb_quantity)){
               
                $salesStock->updateS($stb_quantity,$p_id);
                $productArray = $salesStock->selectOne($p_id);
                $productName = $productArray['p_name'];

                        $_SESSION['success_msg'] = "$productName EDITED SUCCESSFULLY !!!";

                    
                    $employee_id = $_SESSION['logged_user']['e_id'];
                    $e_id = $employee_id;
                    $m_action = " EDITED $productName INFORMATION";
                    $m_hour = date("H:i:s");
                    $m_day = date("l");
                    $m_date = date("Y-m-d");
                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                    // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/salesStock.php");
                $users->directLink("SESSIONS/SUBSESSIONS/salesStock.php");

            }
        }
        

         break;
 	default:
 		// code...
 		break;
 } 





 ?>