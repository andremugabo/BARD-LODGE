<?php
session_start();
require_once '../DAO/OincomeDao.php';
require_once '../DAO/MetricDao.php';


$action = $_GET['action'];
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$oincomeDao = new OincomeDao();
$oincomeObj = new Oincome();



switch($action){
    case 'create':
        if(isset($_POST['oi_product'])){
            $category = $_POST['oi_category'];
            $name =   $_POST['p_name'];
            $price = $_POST['p_price'];

            if(!empty($category) && !empty($name) && !empty($price)){
                $oincomeObj->setOiCategory($category);
                $oincomeObj->setOiName($name);
                $oincomeObj->setOiPrice($price);

                $countName = $oincomeDao->checkOIncomeExists($oincomeObj);
                if($countName == 0){
                    $e_id = $_SESSION['logged']['E_ID'];
                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = $name."  CREATED SUCCESSFULLY ";
                    $metricObj->setMDesc($mDesc);

                    if(isset($_SESSION['currentSession']))
                    {
                        $metricObj->setSId($_SESSION['currentSession']);

                    }
                    else
                    {
                        $metricObj->setSId(null);
                    }
                    $_SESSION['success_msg'] =" PRODUCT $name CREATED SUCCESSFULLY!!!";
                    $metricDaoObj->createMetric($metricObj);
                    $oincomeDao->createOincame($oincomeObj);
                    header("location:{$_SERVER['HTTP_REFERER']}");

                }else{
                    $_SESSION['fail_msg']="THE PRODUCT EXIST !! ";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                }


            }else{
                $_SESSION['fail_msg']="ERROR FEEL OUT ALL TEXT FIELD !! ";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
        }else{
            $_SESSION['fail_msg']="YOU DON'T HAVE PERMISSION FOR THIS ACTION ";
            header('location:../../');
            session_destroy(); 
        }
        break;

    case 'edit':
        if(isset($_POST['editOIncome'])){
            $id = $_POST['oi_id'];
            $category = $_POST['oi_category'];
            $name =   $_POST['p_name'];
            $price = $_POST['p_price']; 
            if(!empty($category) && !empty($name) && !empty($price) && !empty($id)){
                $oincomeObj->setOiId($id);
                $oincomeObj->setOiCategory($category);
                $oincomeObj->setOiName($name);
                $oincomeObj->setOiPrice($price);
               
                $e_id = $_SESSION['logged']['E_ID'];
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = $name." EDITED SUCCESSFULLY ";
                $metricObj->setMDesc($mDesc);

                if(isset($_SESSION['currentSession']))
                {
                    $metricObj->setSId($_SESSION['currentSession']);

                }
                else
                {
                    $metricObj->setSId(null);
                }
                $_SESSION['success_msg'] =" PRODUCT $name EDITED SUCCESSFULLY!!!";
                $metricDaoObj->createMetric($metricObj);
                $oincomeDao->editOincame($oincomeObj);
                header("location:../../pages/PRODUCTS/billardAndRoom.php");
            }else{
                $_SESSION['fail_msg']="ERROR FEEL OUT ALL TEXT FIELD !! ";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
        }else{
            $_SESSION['fail_msg']="YOU DON'T HAVE PERMISSION FOR THIS ACTION ";
            header('location:../../');
            session_destroy(); 
        }
        break;
    default:
    header('location:../../');
    session_destroy();    
    break;     
}

?>