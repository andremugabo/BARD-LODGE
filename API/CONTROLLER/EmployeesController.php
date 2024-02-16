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
        
        if (isset($_POST['addEmployee'])) {
            // Sanitize input to prevent XSS and SQL injection
            $employee_lname = strtoupper(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
            $employee_fname = ucfirst(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
            $employee_phone = filter_input(INPUT_POST, 'e_phone', FILTER_SANITIZE_STRING);
            $employee_role = filter_input(INPUT_POST, 'e_role', FILTER_SANITIZE_STRING);
            $employee_idnumber = filter_input(INPUT_POST, 'e_idnumber', FILTER_SANITIZE_STRING);
            $employeeObj->setEPhone($employee_phone);
            
            // Check if employee already exists
            $feedback = $employeeDaoObj->checkIfEmployeeExist($employeeObj);
            if ($feedback > 0) {
              $_SESSION['fail_msg'] = "EMPLOYEE WITH THE SAME PHONE NUMBER EXISTS";
              header("location:" . $_SERVER['HTTP_REFERER']);
              exit; // Stop further execution if employee already exists
            }
            
            // Generate unique employee registration number
            $recodedEmployee = $employeeDaoObj->countEmployee();
            $count = $recodedEmployee + 1;
            $e_regnumber = "GSLE-" . str_pad($count, 4, "0", STR_PAD_LEFT);
          
            // Set employee object properties
            $employeeObj->setERegNumber($e_regnumber);
            $employeeObj->setLastname($employee_lname);
            $employeeObj->setFirstname($employee_fname);
            $employeeObj->setEPhone($employee_phone);
            $employeeObj->setERole($employee_role);
            $employeeObj->setEIdNumber($employee_idnumber);
          
            // Create metric object
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $metricObj->setMDesc("CREATED A NEW EMPLOYEE NAMED {$employee_fname} {$employee_lname}");
          
            // Set session if available
            if (isset($_SESSION['currentSession'])) {
              $metricObj->setSId($_SESSION['currentSession']);
            } else {
              $metricObj->setSId(null);
            }
          
            // Create new employee and metric
            $result = $employeeDaoObj->createEmployee($employeeObj);
            if ($result) {
              $metricDaoObj->createMetric($metricObj);
              $_SESSION['success_msg'] = "{$employee_fname} {$employee_lname} REGISTERED SUCCESSFULLY!!!";
              header("location:" . $_SERVER['HTTP_REFERER']);
              exit; // Stop further execution on success
            } else {
              // Handle createEmployee failure (log error, display message)
              echo "Error creating employee!";
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
                //to review after sessions(Done)
                if(isset( $_SESSION['currentSession']))
                {
                    $metricObj->setSId($_SESSION['currentSession']);

                }
                else
                {
                    $metricObj->setSId(null);
                }
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