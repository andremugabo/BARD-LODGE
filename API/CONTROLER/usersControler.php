<?php
session_start();
require_once"../MODEL/usersModel.php";
require_once"../MODEL/employeeModel.php";
require_once"../MODEL/metricModel.php";

$users = new usersModel();
$employee = new employeeModel();
$metric = new metricModel();


$action = $_GET['action'];
$employeeData = [];
$employeeToUser = [];


switch ($action) {
    case 'login':
        if (isset($_POST['submit_login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            if ($users->login($username,$password) == 1) {
                $_SESSION['logged_user'] = $users->selectLogin($username,$password);
                $employee_id = $_SESSION['logged_user']['e_id'];
                $employeeData = $employee->selectOne($employee_id);
                $employee_role = $employeeData['e_role'];
                $e_id = $employee_id;
                $m_action = " LOGGED IN ";
                $m_hour = date("H:i:s");
                $m_day = date("l");
                $m_date = date("Y-m-d");
                $metric->insert($e_id,$m_action,$m_day,$m_date);

                switch ($employee_role) {
                    case 'MD':
                        $_SESSION['success_msg'] = "WELLCOME";

                        header("location:../../USERS/MD/DASHBOARD/");
                        break;
                    case 'MANAGER':
                        $_SESSION['success_msg'] = "WELLCOME";

                        header("location:../../USERS/MANAGER/DASHBOARD/");
                        break;    
                    case 'CASHIER':
                        $_SESSION['success_msg'] = "WELLCOME";

                        header("location:../../USERS/CASHIER/DASHBOARD/");
                        break; 
                    default:
                        $_SESSION['success_msg'] = "WELLCOME";

                        header("location:../../USERS/WAITER/DASHBOARD/");
                        break;
                }

                
            } else {
                $_SESSION['fail_msg'] = " WRONG CREDENTIALS !!!";
                header("location:../../");
            }
            

        }else{
                header("location:../../");

        }
        break;
    case 'insert':
        

        if($action == "insert" && isset($_GET['e_id'])){

					$e_id = $_GET['e_id'];
					// echo $e_id;
					array_push($employeeToUser,$employee->selectOne($e_id));
					$u_name = $employeeToUser[0]['e_phone'];
					$u_names = $employeeToUser[0]['e_names'];
					$u_password = md5("123");

					
					if ($users->checkActiveUser($e_id) == 0) {
						$users->insertUser($e_id,$u_name,$u_password);
						$_SESSION['success_msg'] = "USER CREATED !!!!";
                        $employee_id = $_SESSION['logged_user']['e_id'];
                        $employeeData = $employee->selectOne($employee_id);
                        $employee_role = $employeeData['e_role'];
                        
                        $e_id = $employee_id;
                        $m_action = " INSERTED $u_names INTO SYSTEM USERS";
                        $m_hour = date("H:i:s");
                        $m_day = date("l");
                        $m_date = date("Y-m-d");
                        $metric->insert($e_id,$m_action,$m_day,$m_date);
					} else {
						$_SESSION['fail_msg']="USER ALLREADY REGISTERED !!!!!";
					}
					
					
                        header("location:../../USERS/MD/EMPLOYEE/");
					
					

				}



        break;
    case 'delete':
        if ($action == "delete" && isset($_GET['e_id'])) {
            $e_id = $_GET['e_id'];
            $e_names = $_GET['e_names'];
					// echo $e_id;
					// echo $e_names;
            $users->deleteUser($e_id);

            $_SESSION['fail_msg'] = "$e_names  DELETED SUCCESSFULLY !!!!";

            $employee_id = $_SESSION['logged_user']['e_id'];
            $employeeData = $employee->selectOne($employee_id);
            $e_id = $employee_id;
            $m_action = "$e_names WAS DELETE FROM SYSTEM USERS !!!!";
            $m_hour = date("H:i:s");
            $m_day = date("l");
            $m_date = date("Y-m-d");
            $metric->insert($e_id,$m_action,$m_day,$m_date);
        }

                        header("location:../../USERS/MD/USERS/");

        break;
    case 'updateusername':
        if (isset($_POST['updateUsername'])) {
            $u_name = $_POST['username'];
             $employee_id = $_SESSION['logged_user']['e_id'];
             $users->updateUsername($u_name,$employee_id );


             $_SESSION['success_msg'] = "USERNAME UPDATED SUCCESSFULY !!!!";

             $employeeData = $employee->selectOne($employee_id);
            $e_id = $employee_id;
            $m_action = "UPDATED HIS USERNAME !!!!";
            $m_hour = date("H:i:s");
            $m_day = date("l");
            $m_date = date("Y-m-d");
            $metric->insert($e_id,$m_action,$m_day,$m_date);

            $users->directLink("SETTINGS/");
        }
        break; 
    case 'updatepassword':
        if (isset($_POST['updatePassword'] )) {
            
            $currentPassword = md5($_POST['Currentpassword']);
            $newPassword = $_POST['Newpassword'];
            $ConfirmPassword = $_POST['Newpassword'];

            $employee_id = $_SESSION['logged_user']['e_id'];
            

            if ($users->checkPassword($currentPassword) == 0) {
                 $_SESSION['fail_msg'] = "WRONG PASSWORD  !!!!";
                  $users->directLink("SETTINGS/");
            } else {
                if ($newPassword == $ConfirmPassword ) {
                    $u_password = md5($newPassword);
                    $users->updatePassword($u_password,$employee_id );
                    $_SESSION['success_msg'] = "PASSWORD UPDATED SUCCESSFULY !!!!";
                    $users->directLink("SETTINGS/");

                } else {
                    $_SESSION['fail_msg'] = "PASSWORD DONT MATCH !!!!";
                    $users->directLink("SETTINGS/");
                }
                
            }
            
        }
        break;           
    default:
        # code...
        break;
}




?>