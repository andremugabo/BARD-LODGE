<?php
session_start();
require_once"../MODEL/employeeModel.php";
require_once"../MODEL/metricModel.php";

$employee = new employeeModel();
$metric = new metricModel();
$action = $_GET['action'];
$data = [];


switch ($action) {
	case 'insert':
	if (isset($_POST['addEmployee'])) {
       


        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $e_names =strtoupper($lastname)." ".ucfirst($firstname);
        $e_role = $_POST['e_role'];
        $e_email = $_POST['e_email'];
        $e_phone = $_POST['e_phone'];

        $countEmployee = $employee->countEmployee();
        $count = $countEmployee + 1; 

        if ($count < 10) {

            $e_regnumber = "XLE-"."000".$count;

        } elseif ($count >=10  && $count < 100 ) {
            $e_regnumber = "XLE-"."00".$count;
        }elseif(($count >= 100) && ($count < 1000)) {
            $e_regnumber = "XLE-"."0".$count;
        }else{
            $e_regnumber = "XLE-".$count;
        }

        if (!empty($e_names) && !empty($e_role) && !empty($e_email) && !empty($e_phone) && !empty($e_regnumber)) {
        
            if ($employee->checkEmployeeExist($e_email,$e_phone) == 0) {

            $employee->insert($e_regnumber,$e_names,$e_role,$e_email,$e_phone);
                        $_SESSION['success_msg'] = "$e_names REGISTERED SUCCESSFULLY!!!";

                        $employee_id = $_SESSION['logged_user']['e_id'];
                        $employeeData = $employee->selectOne($employee_id);
                        $employee_role = $employeeData['e_role'];
                        $e_id = $employee_id;
                        $m_action = " EDITED $e_names RECORDS BY SETTING HIS/HER ROLE TO $e_role IN EMPLOYEES TABLE ";
                        $m_hour = date("H:i:s");
                        $m_day = date("l");
                        $m_date = date("Y-m-d");
                        $metric->insert($e_id,$m_action,$m_day,$m_date);
                        header("location:../../USERS/MD/EMPLOYEE/");


            } else{
                $_SESSION['fail_msg'] = "EMAIL OR PHONE EXIST TRY AGAIN !!!"; 
                        header("location:../../USERS/MD/EMPLOYEE/");

            }
            
                
                
            
        } 



    }
	
	
	
		
		break;
	case 'edit':
        
        if(isset($_POST['editEmployee'])){
            $e_id = $_POST['e_id'];
            $e_names =$_POST['e_names'];
            $e_role = $_POST['e_role'];
            $e_email = $_POST['e_email'];
            $e_phone = $_POST['e_phone'];

            if(!empty($e_names) && !empty($e_role) && !empty($e_email) && !empty($e_phone) && !empty($e_id)){
               
                $employee->edit($e_names,$e_role,$e_email,$e_phone,$e_id);

                    $_SESSION['success_msg'] = "$e_names EDITED SUCCESSFULLY !!!";

                    // echo $_SESSION['logged_user']['e_id'];
                    $employee_id = $_SESSION['logged_user']['e_id'];
                    $employeeData = $employee->selectOne($employee_id);
                    $employee_role = $employeeData['e_role'];
                    $e_id = $employee_id;
                    $m_action = " EDITED $e_names RECORDS BY SETTING HIS/HER ROLE TO $e_role IN EMPLOYEES TABLE ";
                    $m_hour = date("H:i:s");
                    $m_day = date("l");
                    $m_date = date("Y-m-d");
                    $metric->insert($e_id,$m_action,$m_day,$m_date);
                    header("location:../../USERS/MD/EMPLOYEE/");
            }
        }
        break;
	default:
		// code...
		break;
}
?>