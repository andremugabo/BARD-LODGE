<?php 
require_once"db.php";
class balanceModel extends db{

	

	public function selectOpen(){
		$sql = " SELECT orders.*,bill.*,balance.* FROM balance JOIN orders ON orders.o_reference = balance.o_reference JOIN bill ON bill.b_reference = balance.b_reference  WHERE balance.bl_status = 'Open' ORDER BY bl_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectOpenE_id($waiter){
		$sql = " SELECT orders.*,bill.*,balance.* FROM balance JOIN orders ON orders.o_reference = balance.o_reference JOIN bill ON bill.b_reference = balance.b_reference  WHERE balance.bl_status = 'Open' AND balance.waiter = ? ORDER BY bl_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$waiter
		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectClosed(){
		$sql = " SELECT orders.*,bill.*,balance.* FROM balance JOIN orders ON orders.o_reference = balance.o_reference JOIN bill ON bill.b_reference = balance.b_reference  WHERE balance.bl_status = 'Closed' ORDER BY bl_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectClosedE_id($waiter){
		$sql = " SELECT orders.*,bill.*,balance.* FROM balance JOIN orders ON orders.o_reference = balance.o_reference JOIN bill ON bill.b_reference = balance.b_reference  WHERE balance.bl_status = 'Closed' AND balance.waiter = ? ORDER BY bl_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$waiter
		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
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


	// public function checkObillExist($o_reference){
	// 	$sql = "SELECT b_reference FROM bill WHERE bill.o_reference = ? ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(
	// 		$o_reference
	// 	));
	// 	$result = $statement->rowCount();
	// 	return $result;
	// }



	public function insert($o_reference,$b_reference,$cashier,$waiter,$bl_amount){
		$sql = "INSERT INTO balance(o_reference,b_reference,cashier,waiter,bl_amount) VALUES(?,?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$o_reference,
			$b_reference,
			$cashier,
			$waiter,
			$bl_amount
            
		));     
		
	}


	public function updateCashier($bl_id){
		$sql = "UPDATE balance SET bl_payment = 'PAID' WHERE bl_id = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

            $bl_id
            
		));    
		
	}



    public function updateWaiter($bl_id){
		$sql = "UPDATE balance SET bl_status = 'Closed' WHERE bl_id= ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

            $bl_id
            
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