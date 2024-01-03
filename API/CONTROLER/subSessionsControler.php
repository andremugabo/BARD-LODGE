<?php 
session_start();
require_once"../MODEL/subSessionsModel.php";
require_once"../MODEL/employeeModel.php";
require_once"../MODEL/metricModel.php";
require_once"../MODEL/usersModel.php";


$subsession = new subSessionsModel();
$employee = new employeeModel();
$metric = new metricModel();
$users = new usersModel();

$action = $_GET['action'];
$sessionData = [];
$data = [];

// $s_ref = $_GET['ref'];
// echo $s_ref;
switch ($action) {
	case 'createSubSession':

        $s_reference = $_GET['ref'];


		if ($subsession->checkexist($s_reference) === 0) {
			
			$count = $subsession->countsubSession();
			$countsubSession = $count + 1;

				

				if ($countsubSession < 10) {
					$sub_reference = "subSession/".date('d-m-Y')."/000".$countsubSession;
				} elseif($countsubSession = 10 && $countsubSession < 100) {
					$sub_reference = "subSession/".date('d-m-Y')."/00".$countsubSession;
				}elseif($countsubSession = 100 && $countsubSession < 1000){
					$sub_reference = "subSession/".date('d-m-Y')."/".$countsubSession;
				}
				
				if(!empty($s_reference)){
					$subsession->insert($s_reference,$sub_reference,"NORMAL");
					
                $employee_id = $_SESSION['logged_user']['e_id'];
                $e_id = $employee_id;
                $m_action = "SUBSESSION WITH REFERENCE $sub_reference WAS CREATED ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);
                
                $_SESSION['success_msg'] = "SUBSESSION WITH REFERENCE $sub_reference WAS CREATED SUCCESSFULLY !!!";

                // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/subSession.php");
                $users->directLink("SESSIONS/SUBSESSIONS/subSession.php");


					}else {
						$_SESSION['fail_msg'] = "FAILED TO CREATE A NEW SUBSESSION !!!"; 
                        // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/");
                $users->directLink("SESSIONS/SUBSESSIONS/");

					}

		} else {
			            $_SESSION['fail_msg'] = "FIRST CLOSE AN OPEN SESSION !!!"; 
                        // header("location:../../USERS/MD/SESSIONS/");
                $users->directLink("SESSIONS/");

		}

		
		
		
		
		break;
	case 'vip':
        if (isset($_GET['sub_id'])) {
            $sub_id = $_GET['sub_id'];
            $subsession->vip($sub_id);

            $employee_id = $_SESSION['logged_user']['e_id'];
            $e_id = $employee_id;
            $m_action = "VIP SUBSESSION STARTED SUCCESSFULLY !! ";
            $m_hour = date("H:i:s");
            $m_day = date("l");
            $m_date = date("Y-m-d");
            $metric->insert($e_id,$m_action,$m_day,$m_date);
            
            $_SESSION['success_msg'] = "VIP SUBSESSION START SUCCESSFULLY !!";

            // header("location:../../USERS/MD/SESSIONS/SUBSESSIONS/subSession.php");
                $users->directLink("SESSIONS/SUBSESSIONS/subSession.php");

        }
        break;
	default:
		// code...
		break;

}




 ?>