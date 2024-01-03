<?php 
require_once"db.php";
class stockModel extends db{

	public function insert($e_id,$sub_id,$p_id,$st_quantity){
		$sql = "INSERT INTO stock(e_id,sub_id,p_id,st_quantity) VALUES(?,?,?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id,
			$sub_id,
			$p_id,
			$st_quantity
		));
	}


	public function checkIfproductExist($p_id){
		$sql = "SELECT * FROM stock WHERE stock.p_id = :p_id";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":p_id" => $p_id,
		));
		$results = $statement->rowCount();
		return $results;
	}



	public function checkIfproductExistCat_id($cat_id){
		$sql = "SELECT products.*,stock.* FROM stock JOIN products ON products.p_id = stock.p_id WHERE products.cat_id = :cat_id";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":cat_id" => $cat_id,			
		));
		$results = $statement->rowCount();
		return $results;
	}


	public function selectAll(){
		$sql = "SELECT employee.e_id,employee.e_names,subsession.*,products.*,stock.* FROM stock JOIN employee ON employee.e_id = stock.e_id JOIN subsession ON subsession.sub_id = stock.sub_id  JOIN products ON products.p_id = stock.p_id WHERE products.p_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}		

	}


	public function selectOne($p_id){
		$sql = "SELECT products.*,stock.* FROM stock  JOIN products ON products.p_id = stock.p_id WHERE products.p_status = '1' AND stock.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$p_id

		));

		$result = $statement->fetch();
		return $result;
	}




	public function selectSubsession(){
		$sql = "SELECT * FROM stock ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}
	}


	public function selectOneCat($cat_id){
		$sql = "SELECT products.*,stock.* FROM stock  JOIN products ON products.p_id = stock.p_id WHERE products.p_status = '1' AND products.cat_id =? ";
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


	public function update($e_id,$sub_id,$st_quantity,$p_id){
		$sql = "UPDATE  stock SET e_id=?,sub_id=?,st_quantity=? WHERE stock.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			$e_id,
			$sub_id,
			$st_quantity,
			$p_id
			

		));
		
	}


	public function updateS($st_quantity,$p_id){
		$sql = "UPDATE  stock SET st_quantity=? WHERE stock.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			$st_quantity,
			$p_id
			

		));
		
	}


	// CLOSED STOCK START 

	public function countSessionInClosedStock(){
		$sql = "SELECT DISTINCT(cs_date) FROM closing_stock"; 
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}

	public function SessionInClosedStock(){
		$sql = "SELECT DISTINCT(cs_date), subsession.*,closing_stock.cs_date FROM closing_stock JOIN subsession ON subsession.sub_id = closing_stock.sub_id ORDER BY cs_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}
		
	}


	public function selectSessionInClosedStock($cs_date){
		$sql = "SELECT DISTINCT(closing_stock.p_id), subsession.*,closing_stock.*,products.* FROM closing_stock JOIN subsession ON subsession.sub_id = closing_stock.sub_id JOIN products ON products.p_id = closing_stock.p_id WHERE closing_stock.cs_date = ? ORDER BY products.p_code ASC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$cs_date
		));

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}
		
	}




}




 ?>