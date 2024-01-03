<?php   
require_once"db.php";
class productsModel extends db{

	public function insert($pd_id,$cat_id,$p_code,$p_name,$p_brand){
		$sql = "INSERT INTO products(pd_id,cat_id,p_code,p_name,p_brand) VALUES(?,?,?,?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$pd_id,
			$cat_id,
			$p_code,
			$p_name,
			$p_brand
		));
	}


	public function checkIfproductExist($cat_id,$p_name,$p_brand){
		$sql = "SELECT * FROM products WHERE products.cat_id = :cat_id AND products.p_name = :p_name AND products.p_brand = :p_brand";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":cat_id" => $cat_id,
			":p_name" => $p_name,
			":p_brand" => $p_brand
		));
		$results = $statement->rowCount();
		return $results;
	}



	public function checkIfproductExistCat_id($cat_id){
		$sql = "SELECT * FROM products WHERE products.cat_id = :cat_id";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":cat_id" => $cat_id,
			
		));
		$results = $statement->rowCount();
		return $results;
	}


	public function selectActive(){
		$sql = "SELECT products.*,category.cat_id,category.cat_name,productsdescription.* FROM products JOIN category ON category.cat_id = products.cat_id JOIN productsdescription ON productsdescription.pd_id = products.pd_id WHERE products.p_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}		

	}


	public function selectOne($p_id){
		$sql = "SELECT products.*,category.cat_id,category.cat_name,productsdescription.* FROM products  JOIN category ON category.cat_id = products.cat_id JOIN productsdescription ON productsdescription.pd_id = products.pd_id WHERE products.p_id =? AND products.p_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$p_id

		));

		$result = $statement->fetch();
		return $result;
	}


	public function selectCode($p_code){
		$sql = "SELECT products.*,category.cat_id,category.cat_name,productsdescription.* FROM products  JOIN category ON category.cat_id = products.cat_id JOIN productsdescription ON productsdescription.pd_id = products.pd_id WHERE products.p_code =? AND products.p_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$p_code

		));

		$result = $statement->fetch();
		return $result;
	}


	public function selectOneCat($cat_id){
		$sql = "SELECT products.*,category.cat_id,category.cat_name,productsdescription.* FROM products  JOIN category ON category.cat_id = products.cat_id JOIN productsdescription ON productsdescription.pd_id = products.pd_id WHERE products.cat_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$cat_id

		));

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}	
	}


	public function selectCategoryDrinks(){
		$sql = "SELECT products.*,category.cat_id,category.cat_name,productsdescription.* FROM products  JOIN category ON category.cat_id = products.cat_id JOIN productsdescription ON productsdescription.pd_id = products.pd_id WHERE products.pd_id = 1 ORDER BY  products.p_code";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}	
	}

	public function selectCategoryFoods(){
		$sql = "SELECT products.*,category.cat_id,category.cat_name,productsdescription.* FROM products  JOIN category ON category.cat_id = products.cat_id JOIN productsdescription ON productsdescription.pd_id = products.pd_id WHERE products.pd_id = 2 OR products.pd_id = 3 ORDER BY  products.p_code ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}	
	}


	public function edit($pd_id,$cat_id,$p_name,$p_brand,$p_id){
		$sql = "UPDATE  products SET pd_id=?,cat_id=?,p_name=?,p_brand=? WHERE products.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			$pd_id,
			$cat_id,
			$p_name,
			$p_brand,
			$p_id

		));
		
	}


	public function countProducts(){
		$sql = "SELECT * FROM products";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}




}




 ?>