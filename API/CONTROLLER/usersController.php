<?php

require_once '../DAO/UsersDao.php';
require_once '../DAO/MetricDao.php';
require_once '../DAO/EmployeesDao.php';

$action = $_GET['action'];
$userDaoObj = new UsersDao();
$userObj = new Users();
$employeeDaoObj = new EmployeesDao();
$employeeObj = new Employees();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action){
    case 'login':
        
        if(isset($_POST['user_login']))
        {
            $userObj->setUName($_POST['username']);
            $userObj->setUPassword($_POST['password']);
            $feedback = $userDaoObj->checkIfUserExist($userObj);
            if($feedback > 0)
            {
                //Get user id 
                $getUserId = $userDaoObj->getUserId($userObj);
                //fetch user information
                $employeeObj->setEId($getUserId['e_id']);
                //set session for logged user
                $_SESSION['logged'] = $employeeDaoObj->getEmployeeById($employeeObj);

                //create metric 
                //set user for metric 
                $metricObj->setEId($getUserId['e_id']);
                $mDesc = " HAS LOGGED IN  ";
                $metricObj->setMDesc($mDesc);
                //to review after sessions
                $metricObj->setSId(null);
                $result = $metricDaoObj->createMetric($metricObj);
                echo "  ".$result;


                print_r($_SESSION['logged']);
                $_SESSION['success_msg'] = $_SESSION['logged']['FIRSTNAME']." LOGIN SUCCESSFULLY !! ";
                // header('location:../../PAGES/DASHBOARD/dashboard.php');
            }
            else
            {
                $_SESSION['fail_msg']="FAILED TO LOGIN CONTACT SYSTEM ADMIN";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }

        }
        break;

}







?>