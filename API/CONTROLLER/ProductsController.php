<?php
session_start();
require_once '../DAO/ProductsDao.php';
require_once '../DAO/MetricDao.php';


$action = $_GET['action'];
$productObj = new Products();
$productDaoObj = new ProductsDao();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();


switch($action){
    case 'insert':
        $p_name = strtoupper($_POST['p_name']);
        $productObj->setPName($p_name);
        $productObj->setPcId($_POST['pc_id']);
        $productObj->setUnityId($_POST['unity_id']);
        //check if product exist
        $feedback = $productDaoObj->checkIfProductExist($productObj);
        if($feedback == 0)
        {
            $_SESSION['fail_msg']="PRODUCT WITH THE SAME NAME EXIST";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        else
        {
            $recodedProducct = $productDaoObj->checkIfProductExist($productObj);
            
        }

        echo "insert";
        break;
}






?>