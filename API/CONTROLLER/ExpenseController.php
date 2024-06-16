<?php
session_start();
require_once '../DAO/ExpenseDao.php';
require_once '../DAO/MetricDao.php';


$action = $_GET['action'];
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$expenseDao = new ExpenseDao();
$expenseObj = new Expense();


switch($action){
    case 'insert':
        $s_id = $_GET['s_id'];

        if(isset($_POST['CreateExpense'])){
            if(!empty($_POST['category'] && !empty($_POST['description']) && !empty($_POST['amount']))){

                $category = $_POST['category'];
                $description = $_POST['description'];
                $amount = $_POST['amount'];

                $expenseObj->setSId($s_id);
                $expenseObj->setExpCategory($category);
                $expenseObj->setExpDescription($description);
                $expenseObj->setExpAmount($amount);

                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " EXPENSE CREATED  ";
                $metricObj->setMDesc($mDesc);
                //to review after sessions(Done)
                if(isset($_SESSION['currentSession']))
                {
                    $metricObj->setSId($_SESSION['currentSession']);
    
                }
                else
                {
                    $metricObj->setSId(null);
                }
                $_SESSION['success_msg'] ="EXPENSE CREATED  SUCCESSFULLY!!!";
                $metricDaoObj->createMetric($metricObj);
                $expenseDao->createExpense($expenseObj);
                header("location:{$_SERVER['HTTP_REFERER']}");
            }else{
                $_SESSION['fail_msg']="ERROR FEEL OUT ALL TEXT FIELD !! ";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
        }else{
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break;
    case 'disable':
        $exp_id = $_GET['exp_id'];
        $expenseObj->setExpId($exp_id);
        
        break;    
}

?>