<?php
session_start();
require_once '../DAO/UnityDao.php';
require_once '../DAO/MetricDao.php';


$action = $_GET['action'];
$unityDao = new UnityDao();
$unityObj = new Unity();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action)
{
    case 'insert':
        if(isset($_POST['addUnity'])){
             if(!empty($_POST['unity_name'])){
                $unityObj->setUnityName($_POST['unity_name']);
                $feedback = $unityDao->checkIfUnityExist($unityObj);
                
                if($feedback == 0){
                    // echo $feedback;
                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = " PRODUCT IMAGES UPDATED SUCCESSFULLY!!! ";
                    $metricObj->setMDesc($mDesc);
                    if(isset( $_SESSION['currentSession']))
                    {
                     $metricObj->setSId($_SESSION['currentSession']);
         
                    }
                    else
                    {
                        $metricObj->setSId(null);
                    }
                     $_SESSION['success_msg'] =" PRODUCT IMAGE UPDATED SUCCESSFULLY!!!";
                     $metricDaoObj->createMetric($metricObj);
                     $unityDao->createUnity($unityObj);
                     header("location:../../PAGES/PRODUCTS/unityDisplay.php");
                }else{
                    $_SESSION['fail_msg']=" UNITY EXIST !!!";
                    header("location:{$_SERVER['HTTP_REFERER']}"); 
                }
             }else{
                $_SESSION['fail_msg']=" ENTER UNITY NAME !!!";
                header("location:{$_SERVER['HTTP_REFERER']}"); 
             }   
        }else{
            header("location:{$_SERVER['HTTP_REFERER']}"); 
        }
        break;
    case 'edit':
        if(!empty($_POST['unity_name']) && $_POST['unity_id']){
            $unityObj->setUnityId($_POST['unity_id']);
            $unityObj->setUnityName($_POST['unity_name']);

            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " PRODUCT IMAGES UPDATED SUCCESSFULLY!!! ";
            $metricObj->setMDesc($mDesc);
            if(isset( $_SESSION['currentSession']))
            {
             $metricObj->setSId($_SESSION['currentSession']);
 
            }
            else
            {
                $metricObj->setSId(null);
            }
             $_SESSION['success_msg'] =" PRODUCT UNITY UPDATED SUCCESSFULLY!!!";
             $metricDaoObj->createMetric($metricObj);
             $unityDao->updateUnity($unityObj);
             header("location:../../PAGES/PRODUCTS/unityDisplay.php");

        }else{
            header("location:{$_SERVER['HTTP_REFERER']}"); 
        }
        break;



    
    
    default:
    header('location:../../');
    session_destroy();    
    break;       
    }

?>