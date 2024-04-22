<?php
session_start();
require_once '../DAO/SpecialDetailsDao.php';
require_once '../DAO/MetricDao.php';
require_once '../DAO/ProductCategoryDao.php';
require_once '../DAO/SpecialDao.php';
require_once '../DAO/SStockDao.php';

$action = $_GET['action'];
$specialDetailsDao = new SpecialDetailsDao();
$specialDetails = new SpecialDetails();
$productCategoryDaoObj = new ProductCategoryDao();
$productCategoryObj = new ProductCategory();
$specialDaoObj = new SpecialDao();
$specialObj = new Special();
$SStockDaoObj = new SStockDao();
$SStockObj = new SStock();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$productData = [];



switch($action){
    case 'insert':
        if(isset($_POST['placeSpecial'])){
                if(!empty($_POST['p_qty']) && $_POST['p_qty'] > 0){
                    $specialDetails->setSId($_SESSION['currentSession']);
                    $specialObj->setORef($_GET['o_ref']);
                    $specialInfo = $specialDaoObj->selectSpecialById($specialObj);
                    $specialDetails->setOId($specialInfo['O_ID']);
                    $specialDetails->setEId($_SESSION['logged']['E_ID']);
                    $specialDetails->setPId($_POST['p_id']);
                    $productCategoryObj->setPcId($_POST['pc_id']);
                    $categoryInfo = $productCategoryDaoObj->selectProductCategoryByPcId($productCategoryObj);
                    $specialDetails->setPtId($categoryInfo['PT_ID']);
                    $specialDetails->setPQty($_POST['p_qty']);
                    $specialDetails->setUnityId($_POST['unity_id']);
                    $specialDetails->setPPrice($_POST['p_pprice']);
                    $specialDetails->setSPrice($_POST['p_sprice']);
                    //CREATE

                    $metricObj->setEId($_SESSION['logged']['E_ID']);
                    $mDesc = "  ORDER PLACED ON ".$_GET['o_ref']." ";
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
                    //CHECK THE IF THE PRODUCT EXIST ON ORDER FIRST THE ADJUST QUANTITY
                    $SStockObj->setPId($_POST['p_id']);
                    $isProductExistInSalesStock = $SStockDaoObj->checkIfProductExistSStock($SStockObj);
                    if($isProductExistInSalesStock > 0){
                        $qtyInSaleStock = $SStockDaoObj->selectProductQty($SStockObj);
                        if($qtyInSaleStock['p_qty'] >= $_POST['p_qty']){
                            //new quantity in sales stock
                           $newQtyInSalesStock = $qtyInSaleStock['p_qty'] - $_POST['p_qty'];
                           $SStockObj->setPQty($newQtyInSalesStock);
                           $SStockObj->setPId($_POST['p_id']);

                           $specialDetails->setOId($specialInfo['O_ID']);
                           $specialDetails->setPId($_POST['p_id']);
                           $isProductExistInSpecialDetails = $specialDetailsDao->checkProductOnSpecialDetailsExists($specialDetails);
                          
                           
                           if($isProductExistInSpecialDetails === 0){
                                //update product in sales stock
                                $SStockDaoObj->updateProductQtyOnOrder($SStockObj);
                                $result = $metricDaoObj->createMetric($metricObj);
                                $specialDetailsDao->createSpecialDetails($specialDetails);
                                header("location:{$_SERVER['HTTP_REFERER']}");
                           }else{
                                //get quantity in order details
                                $quantityInSpecialDetails = $specialDetailsDao->selectProductQtySpecialDetails($specialDetails);
                                print_r($quantityInSpecialDetails['p_qty']);
                                $newQtyInSpecialDetails = $quantityInSpecialDetails['p_qty'] + $_POST['p_qty'];
                                $specialDetails->setPQty($newQtyInSpecialDetails);
                                //update product in sales stock
                                $SStockDaoObj->updateProductQtyOnOrder($SStockObj);
                                $specialDetailsDao->updateQtyOnSpecialDetails($specialDetails);
                                header("location:{$_SERVER['HTTP_REFERER']}");
                           }

                          
                           
                          
                        }else{
                            $_SESSION['fail_msg']="NOT ENOUGH PRODUCT IN SALE STOCK ";
                            header("location:{$_SERVER['HTTP_REFERER']}");
                        }
                        

                    }else{
                        $_SESSION['fail_msg']="THIS PRODUCT IS NOT PRESENT IN SALES STOCK ";
                        header("location:{$_SERVER['HTTP_REFERER']}");
                    }



                    



                }else{
                    $_SESSION['fail_msg']="FIRST ENTER THE QUANTITY OF THE PRODUCT GREATER THAN ZERO";
                    header("location:{$_SERVER['HTTP_REFERER']}");

                }
        
        }else{
            header("location:{$_SERVER['HTTP_REFERER']}");

        }
        break;
    case "fetchSpecial":
            $specialObj->setORef($_GET['o_ref']);
            $specialInfo = $specialDaoObj->selectSpecialById($specialObj);
            $specialDetails->setOId($specialInfo['O_ID']);
            $results = $specialDetailsDao->selectSpecialDetailsByOId( $specialDetails);
            array_push($productData,$results);
            echo json_encode($productData);
        break;    
    default:
        header('location:../../');
        session_destroy();    
        break;      
}

header("content-type:application/json");








?>