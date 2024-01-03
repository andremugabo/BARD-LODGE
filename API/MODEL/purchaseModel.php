<?php 
require_once"db.php";
class purchaseModel extends db{

	

	public function select(){
		$sql = " SELECT employee.*,subsession.*,purchase.*,products.* FROM purchase JOIN employee ON employee.e_id = purchase.e_id JOIN subsession ON subsession.sub_id = purchase.sub_id JOIN products ON products.p_id = purchase.p_id  ORDER BY pex_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectOneProduct($sub_id,$p_id,$p_price){
		$sql = " SELECT * FROM purchase WHERE $sub_id = ? AND $p_id =? AND $p_price = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $sub_id,
            $p_id,
            $p_price

        ));

			$result = $statement->fetch();
		    return $result;
		
	}

	// public function selectOne($e_id){
	// 	$sql = "SELECT employee.*,orders.*,subsession.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.e_id = ? ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$e_id

	// 	));

	// 	$result = $statement->fetch();
	// 	return $result;
	// }


	// public function selectBref($b_reference){
	// 	$sql = "SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.b_reference = ?";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$b_reference

	// 	));

	// 	$result = $statement->fetch();
	// 	return $result;
	// }


	// public function selectOref($o_reference){
	// 	$sql = "SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.o_reference = ?";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$o_reference

	// 	));

	// 	$result = $statement->fetch();
	// 	return $result;
	// }


	

	// public function checkbillExist($b_reference){
	// 	$sql = "SELECT b_reference FROM bill WHERE bill.b_reference = ? ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(
	// 		$b_reference
	// 	));
	// 	$result = $statement->rowCount();
	// 	return $result;
	// }


	public function checkPurchaseExist($sub_id,$p_id,$p_price){
		$sql = "SELECT sub_id,p_id,p_price FROM purchase WHERE purchase.sub_id = ? AND purchase.p_id = ? AND purchase.p_price = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$sub_id,
			$p_id,
			$p_price
		));
		$result = $statement->rowCount();
		return $result;
	}



	public function insert($sub_id,$e_id,$p_id,$p_price,$pex_qty,$pex_amount,$pex_date){
		$sql = "INSERT INTO purchase(sub_id,e_id,p_id,p_price,pex_qty,pex_amount,pex_date) VALUES(?,?,?,?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$sub_id,
			$e_id,
			$p_id,
			$p_price,
            $pex_qty,
            $pex_amount,
			$pex_date
            
		));
     
		
	}


	public function updateAmount($pex_qty,$pex_amount,$sub_id,$p_id){
		$sql = "UPDATE purchase SET pex_qty =? , pex_amount = ? WHERE sub_id = ? AND p_id = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			$pex_qty,
			$pex_amount,
			$sub_id,
			$p_id
			
            
		));
     
		
	}

	// public function countBill(){
	// 	$sql = "SELECT * FROM bill";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();
	// 	$results = $statement->rowCount();
	// 	return $results;
	// }

	


}





 ?>