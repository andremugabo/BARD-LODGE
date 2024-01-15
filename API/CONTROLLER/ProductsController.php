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
        if($feedback >  0 )
        {
            $_SESSION['fail_msg']="PRODUCT WITH THE SAME NAME EXIST";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        else
        {
            $recodedProducct = $productDaoObj->countProduct();
            $count = $recodedProducct + 1;

            if($count < 10) {
                $p_code = "P-"."000".$count;
            } elseif ($count >=10  && $count < 100 ) {
                $p_code = "P-"."00".$count;
            }elseif(($count >= 100) && ($count < 1000)) {
                $p_code = "P-"."0".$count;
            }else{
                $p_code = "P-".$count;
            }

            $productObj->setPCode($p_code);


             //create metric 
                //set user id for metric 
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " CREATED A NEW PRODUCT  NAMED ".$p_name;
                $metricObj->setMDesc($mDesc);
                echo $mDesc." ".$e_regnumber;
                //to review after sessions
                $metricObj->setSId(null);
                $_SESSION['success_msg'] = $p_name." REGISTERED SUCCESSFULLY!!!";
                $productDaoObj->createProduct($productObj);
                header("location:{$_SERVER['HTTP_REFERER']}");






            
        }

        // echo "insert";
        break;
    case 'edit':
        // $p_id = $_POST['p_id'];
        // echo $p_id;
        $productObj->setPId($_POST['p_id']);
        $productObj->setPcId($_POST['pc_id']);
        $productObj->setPName(strtoupper($_POST['p_name']));
        $productObj->setUnityId($_POST['unity_id']);

        print_r($productObj);

        $metricObj->setEId($_SESSION['logged']['E_ID']);
        $mDesc = " UPDATED INFORMATION OF ". $employee_fname." ".$employee_lname;
        $metricObj->setMDesc($mDesc);
        //to review after sessions
        $metricObj->setSId(null);
        $_SESSION['success_msg'] = $_POST['p_name']." INFORMATION UPDATED SUCCESSFULLY!!!";
        $result = $metricDaoObj->createMetric($metricObj);
        $productDaoObj->updateProducts($productObj);
        header("location:../../PAGES/PRODUCTS/products.php");

        break; 
    case 'sideDishes':
        echo "sidedish";
        $p_id = $_POST['p_id'];
        echo " <br>";
        echo $p_id;
        $productObj->setPId($p_id);

        $feedback = $productDaoObj->checkIfExistProductsWithSideDishes($productObj);
        if($feedback == 0)
        {
            $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = " PRODUCT UPGRADED TO REQUIRED A SIDE DISHES SUCCESSFULLY!!! ";
            $metricObj->setMDesc($mDesc);
            //to review after sessions
            $metricObj->setSId(null);
            $_SESSION['success_msg'] =" PRODUCT UPGRADED TO REQUIRED A SIDE DISHES SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            $productDaoObj->productsWithSideDishes($productObj);
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        else
        {
            $_SESSION['fail_msg']="PRODUCT ALREADY IS SET TO REQUIRE A SIDE DISH";
            header("location:{$_SERVER['HTTP_REFERER']}");   
        }
        break;   
    case 'disable':
        $p_id = $_GET['id'];
        echo $p_id;
        $productObj->setPId($p_id);

        $metricObj->setEId($_SESSION['logged']['E_ID']);
        $mDesc = " PRODUCT DISABLED FROM THOSE REQUIRED A SIDE DISHES ";
        $metricObj->setMDesc($mDesc);
        //to review after sessions
        $metricObj->setSId(null);
        $_SESSION['success_msg'] =" PRODUCT DISABLED TO REQUIRED A SIDE DISHES SUCCESSFULLY!!!";
        $result = $metricDaoObj->createMetric($metricObj);
        $productDaoObj->disableProductsWithSideDishes($productObj);
        header("location:{$_SERVER['HTTP_REFERER']}");

    break;   
    
    


    default:
    header('location:../../');
    session_destroy();    
    break;    
}






?>