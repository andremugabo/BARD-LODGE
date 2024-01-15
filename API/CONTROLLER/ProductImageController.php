<?php
session_start();
require_once '../DAO/ProductImagesDao.php';
require_once '../DAO/MetricDao.php';
require_once '../MODEL/ProductImages.php';

$action = $_GET['action'];
$productImageDaoObj = new ProductImagesDao();
$productImageObj = new ProductImages();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();

switch($action)
{
    case 'insert':
        if(isset($_POST['addImage']))
        {
            $productImageObj->setPId($_POST['p_id']);
            $p_image = $_FILES['pi_name']['name'];
            $p_imageUpLoad = $_FILES['pi_name']['tmp_name'];
            $dir = "../../ASSETS/PIMAGES/";
            $target_file = $dir.basename($p_image);
            move_uploaded_file($p_imageUpLoad,$target_file);
            $productImageObj->setPiImage($p_image);
            // echo $productImageObj->getPiImage();
            $feedback = $productImageDaoObj->checkIfImageExist($productImageObj);
            if($feedback == 0)
            {
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " PRODUCT IMAGES INSERT SUCCESSFULLY!!! ";
            $metricObj->setMDesc($mDesc);
                 //to review after sessions
            $metricObj->setSId(null);
            $_SESSION['success_msg'] =" PRODUCT IMAGE INSERTED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $productImageDaoObj->createImage($productImageObj);
            header("location:{$_SERVER['HTTP_REFERER']}");
            }
            else
            {
                $_SESSION['fail_msg']=" PRODUCT WITH THAT IMAGE EXIST EXIST !!";
                header("location:{$_SERVER['HTTP_REFERER']}"); 
            }
            

        }
        else
        {
            header("location:{$_SERVER['HTTP_REFERER']}"); 
        }
        break;
    case 'edit':
        if(isset($_POST['editImage']))
        {
            $productImageObj->setPId($_POST['p_id']);
            $productImageObj->setPiId($_POST['pi_id']);
            $p_image = $_FILES['pi_name']['name'];
            $p_imageUpLoad = $_FILES['pi_name']['tmp_name'];
            $dir = "../../ASSETS/PIMAGES/";
            $target_file = $dir.basename($p_image);
            move_uploaded_file($p_imageUpLoad,$target_file);
            $productImageObj->setPiImage($p_image);
            // echo $productImageObj->getPiImage();
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " PRODUCT IMAGES UPDATED SUCCESSFULLY!!! ";
            $metricObj->setMDesc($mDesc);
                 //to review after sessions
            $metricObj->setSId(null);
            $_SESSION['success_msg'] =" PRODUCT IMAGE UPDATED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $productImageDaoObj->updateImage($productImageObj);
            header("location:../../PAGES/PRODUCTS/productImage.php");
            
            

        }
        else
        {
            header("location:{$_SERVER['HTTP_REFERER']}"); 
        }

        break;    



    default:
        header('location:../../');
        session_destroy();    
        break;    

}





?>