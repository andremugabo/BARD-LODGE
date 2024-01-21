<?php
session_start();
require_once '../DAO/ProductCategoryDao.php';
require_once '../DAO/MetricDao.php';
require_once '../MODEL/ProductCategory.php';

$action = $_GET['action'];
$productCategoryDaoObj = new ProductCategoryDao();
$productCategoryObj = new ProductCategory();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$categoryData = [];


switch($action){
    case 'insert':
        if(isset($_POST['addCategory']))
        {
         
            $productCategoryObj->setPtId($_POST['p_type']);
            $productCategoryObj->setPcName(strtoupper($_POST['pc_name']));
            // echo $_POST['pc_name'];
            // echo $_POST['p_type'];
            $feedback = $productCategoryDaoObj->checkIfCategoryExist($productCategoryObj);
            echo $feedback;
            if($feedback == 0)
            {
                
                //create metric 
                //set user id for metric 
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " CREATED A NEW CATEGORY  NAMED ".$_POST['pc_name'];
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
                $_SESSION['success_msg'] = $_POST['pc_name']." REGISTERED SUCCESSFULLY!!!";
                $productCategoryDaoObj->createCategory($productCategoryObj);
                $metricDaoObj->createMetric($metricObj);

                header("location:{$_SERVER['HTTP_REFERER']}");   
            }
            else
            {
                $_SESSION['fail_msg']="CATEGORY EXIST !!";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }

        }
        else
        {
            $_SESSION['fail_msg']="FAILED TO CREATE !!";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break;
    case 'edit':
        if(isset($_POST['editCategory']))
        {
            // echo "EDIT";
            $productCategoryObj->setPcId($_POST['pc_id']);
            $productCategoryObj->setPcName(strtoupper($_POST['pc_name']));
            // echo $_POST['pc_name'];
            // echo strtoupper($_POST['pc_name']);

            //create metric 
            //set user id for metric 
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " EDITED CATEGORY  NAMED ".$_POST['pc_name'];
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
            $_SESSION['success_msg'] = $_POST['pc_name']." UPDATED SUCCESSFULLY!!!";
            $productCategoryDaoObj->updateCategory($productCategoryObj);
            $metricDaoObj->createMetric($metricObj);

            header("location:../../PAGES/PRODUCTS/category.php"); 


        }
        else
        {
            $_SESSION['fail_msg']="FAILED TO UPDATE !!";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break; 
case 'fetchType':
        $pt_id = $_GET['pt_id'];
        $productCategoryObj->setPtId($pt_id);
        $results = $productCategoryDaoObj->selectOneType($productCategoryObj);
        if($results != null){
            array_push($categoryData,$results);
        }else{
            $results = "";
            array_push($categoryData,$results);
        }
        echo json_encode($categoryData);
        break;    
        
        
        
    default:
        header('location:../../');
        session_destroy();    
        break;


}




header("content-type:application/json");
?>