<?php
session_start();
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
            $userObj->setUPassword(md5($_POST['password']));
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
                //set user id for metric 
                $metricObj->setEId($getUserId['e_id']);
                $mDesc = " HAS LOGGED IN  ";
                $metricObj->setMDesc($mDesc);
                //to review after sessions
                $metricObj->setSId(null);
                $result = $metricDaoObj->createMetric($metricObj);
                echo "  ".$result;


                // print_r($_SESSION['logged']);
                $employee_name = $_SESSION['logged']['LASTNAME']." ".$_SESSION['logged']['FIRSTNAME'];
                $_SESSION['success_msg'] = $employee_name." YOU LOGGED SUCCESSFULLY !! ";
                header('location:../../PAGES/DASHBOARD/');
            }
            else
            {
                $_SESSION['fail_msg']="FAILED TO LOGIN CONTACT SYSTEM ADMIN";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }

        }
        break;
    case 'insert':
        if(isset($_GET['action']) == 'insert') 
        {
            echo "insert";
            $e_id = $_GET['e_id'];
            echo $e_id;
            $employeeObj->setEId($e_id);
            $selectEmployee = $employeeDaoObj->getEmployeeById($employeeObj);
            echo"<br>";
            print_r($selectEmployee['E_PHONE']);
            $password = md5(123);

            $userObj->setEId($selectEmployee['E_ID']);
            $userObj->setUName($selectEmployee['E_PHONE']);
            $userObj->setUPassword($password);

            //create metric 
            //set user id for metric 
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " GAVE AN EMPLOYEE WITH ".$selectEmployee['E_PHONE'].", AN ACCESS TO THE SYSTEM AS A USER";
            $metricObj->setMDesc($mDesc);
            //to review after sessions
            $metricObj->setSId(null);
            $result = $metricDaoObj->createMetric($metricObj);
            //create a user

            $feedback = $userDaoObj->checkIfUserExistById($userObj);
            
            echo $feedback;
            if($feedback == 0)
            { 
                $userDaoObj->createUser($userObj);
                $_SESSION['success_msg'] =" USER CREATED SUCCESSFULLY ";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
            else
            {
                $_SESSION['fail_msg']="USER EXIST!!!";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }

        }   
        break; 
    case 'edit':
    
        break; 
    case 'disable':
        if(isset($_GET['action'])== 'disable')
        {
            $getId = $_GET['e_id'];
            $userObj->setEId($getId);

            //create metric 
            //set user id for metric 
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " DISABLED A USER";
            $metricObj->setMDesc($mDesc);
            //to review after sessions
            $metricObj->setSId(null);
            $result = $metricDaoObj->createMetric($metricObj);
            $userDaoObj->disableUser($userObj);
            $_SESSION['success_msg'] =" DISABLED SUCCESSFULLY!! ";
            header("location:{$_SERVER['HTTP_REFERER']}");


        }
        break;          

}







?>