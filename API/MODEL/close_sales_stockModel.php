<?php 
require_once"db.php";
class close_sales_stockModel extends db{

	public function insert($sub_id,$p_id,$css_qty,$p_price,$sub_date){ 
		$sql = "INSERT INTO closing_sales_stock(sub_id,p_id,css_qty,p_price,css_date) VALUES(?,?,?,?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$sub_id,
			$p_id,
			$css_qty,
			$p_price,
			$sub_date
		));
	}


	public function checkIfproductExist($p_id){
		$sql = "SELECT * FROM closing_sales_stock WHERE closing_sales_stock.p_id = :p_id";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":p_id" => $p_id,
		));
		$results = $statement->rowCount();
		return $results;
	}



	public function countSessionInClosedSalesStock(){
		$sql = "SELECT DISTINCT(css_date) FROM closing_sales_stock"; 
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}

	public function SessionInClosedSalesStock(){
		$sql = "SELECT DISTINCT(css_date), subsession.*,closing_sales_stock.css_date FROM closing_sales_stock JOIN subsession ON subsession.sub_id = closing_sales_stock.sub_id ORDER BY css_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}
		
	}


	public function selectSessionInClosedStock($css_date){
		$sql = "SELECT DISTINCT(closing_sales_stock.p_id), subsession.*,closing_sales_stock.*,products.* FROM closing_sales_stock JOIN subsession ON subsession.sub_id = closing_sales_stock.sub_id JOIN products ON products.p_id = closing_sales_stock.p_id WHERE closing_sales_stock.css_date = ? ORDER BY products.p_code ASC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$css_date
		));

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}
		
	}


	




}




 ?>