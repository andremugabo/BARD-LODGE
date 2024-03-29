<?php
ob_start();
session_start();
require_once '../DAO/PricesDao.php';
require_once '../DAO/MetricDao.php';

$priceObj = new Price();
$priceDaoObj = new PricesDao();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$action = $_GET['action'];
$productData = [];
$oneProductData = [];


switch($action){
    case 'insert':
        echo "insert";
        $priceObj->setPId($_POST['p_id']);
        $priceObj->setPPrice($_POST['pprice']);
        $priceObj->setEPrice($_POST['eprice']);
        $priceObj->setSPrice($_POST['sprice']);
        $priceObj->setUnityId($_POST['unity_id']);
        $feedback = $priceDaoObj->checkProductPriceExists($priceObj);
        // echo $feedback;

        if($feedback == 0)
        {
            //set user id for metric 
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = "PRICE  CREATED ";
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
            $_SESSION['success_msg'] ="PRICE CREATED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $priceDaoObj->createPrice($priceObj);
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        else
        {
            $_SESSION['fail_msg']="PRICE IS ALREADY  ACTIVE IT SHOULD BE DISABLED FIRST";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }

        break;
    case 'edit':
        
        if(isset($_POST['editPrice']))
        {
            
             $priceObj->setPriceId($_POST['price_id']);
             $priceObj->setPId($_POST['p_id']);
             $priceObj->setUnityId($_POST['unity_id']);
             $priceObj->setPPrice($_POST['pprice']);
             $priceObj->setSPrice($_POST['sprice']);
             $priceObj->setEPrice($_POST['eprice']);
            
             if($_POST['pprice'] > 0 && $_POST['pprice'] < $_POST['eprice'] && $_POST['sprice'] >= $_POST['eprice'] )
             {
                // echo "edit";
                // echo $_POST['price_id']."  pid:";
                // echo $_POST['p_id'];

                //set user id for metric 
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = "PRICE  UPDATED ";
                $metricObj->setMDesc($mDesc);
                // //to review after sessions(Done)
                if(isset( $_SESSION['currentSession']))
                {
                    $metricObj->setSId($_SESSION['currentSession']);

                }
                else
                {
                    $metricObj->setSId(null);
                }
                $_SESSION['success_msg'] ="PRICE UPDATED SUCCESSFULLY!!!";
                $metricDaoObj->createMetric($metricObj);
                $priceDaoObj->updatePrice($priceObj);
                header("location:../../PAGES/PRODUCTS/price.php");








             }
             else
             {
                $_SESSION['fail_msg']=" ADJUST YOUR PRICE !! CHECK AGAIN ";
                header("location:{$_SERVER['HTTP_REFERER']}");
             }


        }
       
        break;
        // fetch product for order details
        case 'fetchProduct':
            $pc_id = $_GET['pc_id'];
            $results = $priceDaoObj->selectProductByPc_id($pc_id);
            array_push($productData,$results);
            echo json_encode($productData);
            break;     
        case 'fetchOrder':
            $p_id = $_GET['p_id'];
            $price_id = $_GET['price_id'];
            $results = $priceDaoObj->selectProductToOrder($p_id,$price_id);
            array_push($oneProductData,$results);
            echo json_encode($oneProductData);
            break;
        

    default:
        header('location:../../');
        session_destroy();    
        break;        
}







header("content-type:application/json");
?>