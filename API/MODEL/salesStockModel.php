<?php 
require_once"db.php";
class salesStockModel extends db{

	public function insert($e_id,$sub_id,$p_id,$stb_quantity){
		$sql = "INSERT INTO stock_bar(e_id,sub_id,p_id,stb_quantity) VALUES(?,?,?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id,
			$sub_id,
			$p_id,
			$stb_quantity
		));
	}


	public function checkIfproductExist($p_id){
		$sql = "SELECT * FROM stock_bar WHERE stock_bar.p_id = :p_id";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":p_id" => $p_id,
		));
		$results = $statement->rowCount();
		return $results;
	}


	public function checkIfproduct($cat_id){
		$sql = "SELECT products.*,stock_bar.* FROM stock_bar  JOIN products ON products.p_id = stock_bar.p_id WHERE products.p_status = '1' AND products.cat_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$cat_id,
		));
		$results = $statement->rowCount();
		return $results;
	}



	// public function checkIfproductExistCat_id($cat_id){
	// 	$sql = "SELECT * FROM products WHERE products.cat_id = :cat_id";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(
	// 		":cat_id" => $cat_id,			
	// 	));
	// 	$results = $statement->rowCount();
	// 	return $results;
	// }


	public function selectAll(){
		$sql = "SELECT employee.e_id,employee.e_names,subsession.*,products.*,stock_bar.* FROM stock_bar JOIN employee ON employee.e_id = stock_bar.e_id JOIN subsession ON subsession.sub_id = stock_bar.sub_id  JOIN products ON products.p_id = stock_bar.p_id WHERE products.p_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}		

	}


	public function selectOne($p_id){
		$sql = "SELECT products.*,stock_bar.* FROM stock_bar  JOIN products ON products.p_id = stock_bar.p_id WHERE products.p_status = '1' AND stock_bar.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$p_id

		));

		$result = $statement->fetch();
		return $result;
	}


	public function selectProduct($cat_id){
		$sql = "SELECT products.*,stock_bar.* FROM stock_bar  JOIN products ON products.p_id = stock_bar.p_id WHERE products.p_status = '1' AND products.cat_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$cat_id

		));

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}
	}



	// public function selectOneCat($cat_id){
	// 	$sql = "SELECT products.*,category.cat_id,category.cat_name,productsdescription.* FROM products  JOIN category ON category.cat_id = products.cat_id JOIN productsdescription ON productsdescription.pd_id = products.pd_id WHERE products.cat_id =? ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$cat_id

	// 	));

	// 	while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
	// 		return $results;
	// 	}	
	// }


	public function update($e_id,$sub_id,$stb_quantity,$p_id){
		$sql = "UPDATE  stock_bar SET e_id=?,sub_id=?,stb_quantity=? WHERE stock_bar.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			$e_id,
			$sub_id,
			$stb_quantity,
			$p_id
			

		));
		
	}

    public function updateS($stb_quantity,$p_id){
		$sql = "UPDATE  stock_bar SET stb_quantity=? WHERE stock_bar.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			
			$stb_quantity,
			$p_id
			

		));
		
	}

	public function selectSubsession(){
		$sql = "SELECT * FROM stock_bar   ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}
	}


	




}




 ?>