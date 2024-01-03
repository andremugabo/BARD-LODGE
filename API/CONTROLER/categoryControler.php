<?php 
require_once"../CLASS/categoryModel.php";

$category =  new categoryModel();
$action = $_GET['action'];
$data = [];



switch ($action) {
	case 'insert':
	$cat_name =  $_POST['cat_name'];
		
		if (!empty($cat_name)) {
			
			if ($category->checkInsert($cat_name) == 0 ) {
				$response = true;
				$category->insert(strtoupper($cat_name));
				array_push($data,$response);
			} else {
				$response = false;
				array_push($data,$response);
			}
			
		}
		
		break;
	
	default:
		// code...
		break;
}






 ?>