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

// $products = new ProductsDao();

// if (isset($_GET['prod'])) {
//    $cat_id = $_GET['prod'];
    
//    if ($products->checkIfproductExistCat_id($cat_id)!= 0) {
//        echo'<option selected disabled value="">Choose&nbsp;Product</option>';
//        foreach ($products->selectOneCat($cat_id) as $product) {
//            echo "<option value=".$product['p_id'].">".$product['p_name']."</option>";
//        }
//    } else {
//        echo "<option selected disabled value='' >THE PRODUCT IS NOT GIVEN</option>";
//    }
   



// }


require_once "../../INCLUDES/footer.php";

?>