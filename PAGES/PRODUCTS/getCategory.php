<?php
require_once "../../INCLUDES/header.php";
$category = new ProductCategoryDao();
$categoryObj = new ProductCategory();
// print_r($category);

if (isset($_GET['cat'])) {
   $pt_id = $_GET['cat'];
   $categoryObj->setPtId($pt_id);  
    
   if ($category->checkIfCategoryExistByPId($categoryObj)!= 0) {
       echo'<option selected disabled value="">Choose&nbsp;Category</option>';
       foreach ($category->selectOneType($categoryObj) as $categories) {
           echo "<option value=".$categories['PC_ID'].">".$categories['PC_NAME']."</option>";
       }
   } else {
       echo "<option selected disabled value='' >THE CATEGORY IS NOT GIVEN</option>";
   }
   



}

$products = new ProductsDao();
$productsObj = new Products();

if (isset($_GET['prod'])) {
   $pc_id = $_GET['prod'];
   $productsObj->setPcId($pc_id);
    
   if ($products->checkIfCategoryExistByPcId($productsObj)!= 0) {
       echo'<option selected disabled value="">Choose&nbsp;Product</option>';
       foreach ($products->selectProductsByCategory($productsObj) as $product) {
           echo "<option value=".$product['P_ID'].">".$product['P_NAME']."</option>";
       }
   } else {
       echo "<option selected disabled value='' >THE PRODUCT IS NOT GIVEN</option>";
   }
   



}


require_once "../../INCLUDES/footer.php";

?>