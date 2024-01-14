<?php
session_start();
require_once '../DAO/EmployeesDao.php';
require_once '../MODEL/Employees.php';
require_once '../DAO/MetricDao.php';

$action = $_GET['action'];
$employeeDaoObj = new EmployeesDao();
$employeeObj = new Employees();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();



switch($action){
    case 'insert':
        
        if(isset($_POST['addEmployee']))
        {   
            $employee_lname = strtoupper($_POST['lastname']); 
            $employee_fname = ucfirst(($_POST['firstname'])); 
            $employeeObj->setLastname($employee_lname);
            $employeeObj->setFirstname($employee_fname);
            $employeeObj->setEPhone($_POST['e_phone']);
            $employeeObj->setERole($_POST['e_role']);
            $employeeObj->setEIdNumber($_POST['e_idnumber']);
            
            $feedback = $employeeDaoObj->checkIfEmployeeExist($employeeObj);
            echo $feedback;
            if($feedback > 0)
            {
                $_SESSION['fail_msg']="EMPLOYEE WITH THE SAME PHONE NUMBER EXIST";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
            else
            {
                $recodedEmployee = $employeeDaoObj->countEmployee();
                $count =  $recodedEmployee + 1;
                    if ($count < 10) {
                        $e_regnumber = "GSLE-"."000".$count;
                    } elseif ($count >=10  && $count < 100 ) {
                        $e_regnumber = "GSLE-"."00".$count;
                    }elseif(($count >= 100) && ($count < 1000)) {
                        $e_regnumber = "GSLE-"."0".$count;
                    }else{
                        $e_regnumber = "GSLE-".$count;
                    }

                $employeeObj->setERegNumber($e_regnumber);
                // print_r($employeeObj);
                //create metric 
                //set user id for metric 
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " CREATED A NEW EMPLOYEE  NAMED ". $employee_fname." ".$employee_lname;
                $metricObj->setMDesc($mDesc);
                echo $mDesc." ".$e_regnumber;
                //to review after sessions
                $metricObj->setSId(null);
                $_SESSION['success_msg'] = $employee_fname." ".$employee_lname." REGISTERED SUCCESSFULLY!!!";
                $result = $metricDaoObj->createMetric($metricObj);
                $employeeDaoObj->createEmployee($employeeObj);
                header("location:{$_SERVER['HTTP_REFERER']}");



            }




        }
        break;
    case 'edit':
        if(isset($_POST['editEmployee']))
        {
            $employee_lname = strtoupper($_POST['Lastname']); 
            $employee_fname = ucfirst(($_POST['Firstname'])); 
            $employeeObj->setLastname($employee_lname);
            $employeeObj->setFirstname($employee_fname);
            $employeeObj->setEPhone($_POST['e_phone']);
            $employeeObj->setERole($_POST['e_role']);
            $employeeObj->setEIdNumber($_POST['e_idnumber']);
            $employeeObj->setEId($_POST['e_id']);
            //check if employee exist
            $feedback = $employeeDaoObj->checkIfEmployeeExist($employeeObj);
            echo $feedback;
            if($feedback > 0)
            {
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " UPDATED INFORMATION OF ". $employee_fname." ".$employee_lname;
                $metricObj->setMDesc($mDesc);
                //to review after sessions
                $metricObj->setSId(null);
                $_SESSION['success_msg'] = $employee_fname." ".$employee_lname." INFORMATION UPDATED SUCCESSFULLY!!!";
                $result = $metricDaoObj->createMetric($metricObj);
                $employeeDaoObj->updateEmployee($employeeObj);
                header("location:../../PAGES/EMPLOYEES/employees.php");
            }





        }
        break;



    default:
        header('location:../../');
        session_destroy();    
        break;    
        
        
















}

?>