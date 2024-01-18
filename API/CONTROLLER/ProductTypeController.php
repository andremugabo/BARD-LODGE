<?php
session_start();
require_once '../DAO/ProductTypeDao.php';
require_once '../DAO/MetricDao.php';
require_once '../MODEL/ProductType.php';

$action = $_GET['action'];
$productTypeDaoObj = new ProductTypeDao();
$productTypeObj = new ProductType();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();



switch($action){
    case 'insert':
        if(isset($_POST['addType']))
        {
            $productTypeObj->setPtName(strtoupper($_POST['pt_name']));
            $feedback = $productTypeDaoObj->checkIfProductTypeExist($productTypeObj);
            // echo $feedback;
            if($feedback == 0)
            {
                //create metric 
                //set user id for metric 
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " CREATED A NEW TYPE  NAMED ".$_POST['pt_name'];
                $metricObj->setMDesc($mDesc);
                //to review after sessions(Done)
                if(isset( $_SESSION['currentSession']))
                {
                    $metricObj->setSId($getCurrentSession);
                }
                else
                {
                    $metricObj->setSId(null);
                }
                $_SESSION['success_msg'] = $_POST['pt_name']." REGISTERED SUCCESSFULLY!!!";
                $productTypeDaoObj->createProductType($productTypeObj);
                $metricDaoObj->createMetric($metricObj);

                header("location:{$_SERVER['HTTP_REFERER']}");

            }
            else
            {
                $_SESSION['fail_msg']="TYPE EXIST !!";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
            
        }
        break;
    case 'edit':
       
        if(isset($_POST['editType']))
        {
            //  echo $_POST['pt_id'];
             $productTypeObj->setPtId($_POST['pt_id']);
             $productTypeObj->setPtName(strtoupper($_POST['pt_name']));

             //create metric 
            //set user id for metric 
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " UPDATED TYPE  NAMED ".$_POST['pt_name'];
            $metricObj->setMDesc($mDesc);
            //to review after sessions(Done)
            if(isset( $_SESSION['currentSession']))
            {
                $metricObj->setSId($getCurrentSession);
            }
            else
            {
                $metricObj->setSId(null);
            }
            $_SESSION['success_msg'] = $_POST['pt_name']." TYPE UPDATED SUCCESSFULLY!!!";
            $productTypeDaoObj->updateProductType($productTypeObj);
            $metricDaoObj->createMetric($metricObj);

            header("location:../../PAGES/PRODUCTS/productsType.php");


        }
        else
        {
            $_SESSION['fail_msg']="FAILED TO UPDATE !!";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break;  
        
        

        default:
        header('location:../../');
        session_destroy();    
        break;    
}






?>