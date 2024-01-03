<?php 
require_once"db.php";
class close_stockModel extends db{

	public function insert($sub_id,$p_id,$cs_qty,$p_price,$sub_date){
		$sql = "INSERT INTO closing_stock(sub_id,p_id,cs_qty,p_price,cs_date) VALUES(?,?,?,?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$sub_id,
			$p_id,
			$cs_qty,
			$p_price,
			$sub_date
		));
	}


	public function checkIfproductExist($p_id){
		$sql = "SELECT * FROM closing_stock WHERE closing_stock.p_id = :p_id";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":p_id" => $p_id,
		));
		$results = $statement->rowCount();
		return $results;
	}



	




}




 ?>