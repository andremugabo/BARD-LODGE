<?php 
session_start();
require_once"../MODEL/sessionsModel.php";
require_once"../MODEL/employeeModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/stockModel.php";
require_once"../MODEL/salesStockModel.php";
require_once"../MODEL/close_stockModel.php";
require_once"../MODEL/close_sales_stockModel.php";
require_once"../MODEL/subSessionsModel.php";
require_once"../MODEL/priceModel.php";
require_once"../MODEL/usersModel.php";



$session = new sessionsModel();
$employee = new employeeModel();
$metric = new metricModel();
$stocks = new stockModel();
$salesStocks = new salesStockModel();
$close_stocks = new close_stockModel();
$close_sales_stocks = new close_sales_stockModel();
$subsessions = new subSessionsModel();
$prices = new priceModel();
$users = new usersModel();


$action = $_GET['action'];
$sessionData = [];
$data = [];

// print_r($_SESSION['logged_user']['e_id']);

switch ($action) {
	case 'createSession':
       if(isset($_POST['CreateSession'])):
		if ($session->checkOpen() === 0) {
			
            

			$count = $session->countSession();
			$countSession = $count + 1;

				$e_id = $_SESSION['logged_user']['e_id'];

				if ($countSession < 10) {
					$s_reference = "Session/".date('d-m-Y')."/000".$countSession;
				} elseif($countSession = 10 && $countSession < 100) {
					$s_reference = "Session/".date('d-m-Y')."/00".$countSession;
				}elseif($countSession = 100 && $countSession < 1000){
					$s_reference = "Session/".date('d-m-Y')."/".$countSession;
				}
				
				if(!empty($e_id) && !empty($s_reference)){
					$session->insert($e_id,$s_reference);
					
                $employee_id = $_SESSION['logged_user']['e_id'];
                $e_id = $employee_id;
                $m_action = "SESSION WITH REFERENCE $s_reference WAS CREATED ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "SESSION WITH REFERENCE $s_reference WAS CREATED SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/");
                $users->directLink("SESSIONS/");



					}else {
						$_SESSION['fail_msg'] = "FAILED TO CREATE A NEW SESSION !!!"; 
                        // header("location:../../USERS/MD/SESSIONS/");
                $users->directLink("SESSIONS/");

                        
					}

		} else {
			            $_SESSION['fail_msg'] = "FIRST CLOSE AN OPEN SESSION !!!"; 
                        // header("location:../../USERS/MD/SESSIONS/");
                $users->directLink("SESSIONS/");

		}

    endif;

		
		
		
		
		break;
	case 'close':
        if (isset($_GET['s_id'])) {
            $s_id = $_GET['s_id'];
            $s_reference = $_GET['s_ref'];

            $subsession = $subsessions->selectSub($s_reference);
            $sub_id = $subsession['sub_id'];
            $sub_date = $subsession['sub_date'];
            echo "hi";
            if($stocks->selectSubsession()):
            foreach ($stocks->selectSubsession() as $key ) {
                   
                   $p_id = $key['p_id']; 
                   $cs_qty = $key['st_quantity']; 
                   $price = $prices->selectOne($p_id);
                   $p_price =$price['purchase_price'] ;
                   $close_stocks->insert($sub_id,$p_id,$cs_qty,$p_price,$sub_date);

                

            }
        endif;
                if($salesStocks->selectSubsession()):
            foreach ($salesStocks->selectSubsession() as $key ) {
                   $p_id = $key['p_id']; 
                   $css_qty = $key['stb_quantity']; 
                   $price = $prices->selectOne($p_id);
                   $p_price =$price['purchase_price'] ;
                   $close_sales_stocks->insert($sub_id,$p_id,$css_qty,$p_price,$sub_date);
                 

            }
                endif;

            $session->close($s_id);
            $subsessions->close($s_reference);
             


            $employee_id = $_SESSION['logged_user']['e_id'];
            $e_id = $employee_id;
            $m_action = "SESSION $s_reference  CLOSED SICCESSFULLY !! ";
            $m_hour = date("H:i:s");
            $m_day = date("l");
            $m_date = date("Y-m-d");
            $metric->insert($e_id,$m_action,$m_day,$m_date);
            
            $_SESSION['success_msg'] = "SESSION $s_reference  CLOSED SICCESSFULLY !!";

            // header("location:../../USERS/MD/SESSIONS/");
                $users->directLink("SESSIONS/");

        }
        break;
	default:
		// code...
		break;

}




 ?>