<?php 
require_once"db.php";
class billsModel extends db{

	

	public function selectNPaid(){
		$sql = " SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.payment_status = 'NOT PAID' AND bill.b_status= '1' ORDER BY bill.b_reference DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function salesReport($where,$bydate,$bysubtype,$byeid){
		$sql = " SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  ".$where.$bydate.$bysubtype.$byeid."  bill.payment_status = 'PAID'  ORDER BY bill.b_reference DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array());

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}


	public function salesReportByOne($bydate,$bysubtype,$byeid){
		$sql = " SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  ".$where.$bydate.$bysubtype.$byeid."  ORDER BY b_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array());

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function salesReportByWaiter($where,$bydate,$byeid){
		$sql = " SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  ".$where.$bydate.$byeid." payment_status = 'PAID' ORDER BY b_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array());

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectPaid(){
		$sql = " SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.payment_status = 'PAID' ORDER BY o_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectPaidCredit(){
		$sql = " SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.payment_mode = 'CREDIT' ORDER BY o_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectOne($e_id){
		$sql = "SELECT employee.*,orders.*,subsession.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.e_id = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$e_id

		));

		$result = $statement->fetch();
		return $result;
	}

	// public function selectWaiterOne($e_id,$sessionDate){
	// 	$sql = "SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE orders.e_id=".$e_id." AND  bill.b_date=".$sessionDate."  ORDER BY b_date DESC ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();

	// 	while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
	// 		return $result;
	// 	}
	// }


	public function selectBref($b_reference){
		$sql = "SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.b_reference = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$b_reference

		));

		$result = $statement->fetch();
		return $result;
	}


	public function selectOref($o_reference){
		$sql = "SELECT employee.*,orders.*,bill.* FROM bill JOIN employee ON employee.e_id = bill.e_id JOIN orders ON orders.o_reference = bill.o_reference  WHERE bill.o_reference = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$o_reference

		));

		$result = $statement->fetch();
		return $result;
	}


	

	public function checkbillExist($b_reference){
		$sql = "SELECT b_reference FROM bill WHERE bill.b_reference = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$b_reference
		));
		$result = $statement->rowCount();
		return $result;
	}


	public function checkObillExist($o_reference){
		$sql = "SELECT b_reference,o_reference FROM bill WHERE bill.o_reference = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$o_reference
		));
		$result = $statement->rowCount();
		return $result;
	}



	public function insert($b_reference,$o_reference,$e_id,$waiter,$sub_type,$payment_status,$b_date){
		$sql = "INSERT INTO bill(b_reference,o_reference,e_id,waiter,sub_type,payment_status,b_date) VALUES(?,?,?,?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$b_reference,
			$o_reference,
			$e_id,
			$waiter,
			$sub_type,
			$payment_status,
			$b_date
            
		));
     
		
	}


	public function update($payment_mode,$payment_status,$b_amount,$b_reference){
		$sql = "UPDATE bill SET payment_mode = ?,payment_status = ?,b_amount = ? WHERE b_reference = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			$payment_mode,
			$payment_status,
			$b_amount,
			$b_reference
            
		));
     
		
	}

	public function countBill(){
		$sql = "SELECT * FROM bill";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}

	public function countBillbyDate($date){
		$sql = "SELECT * FROM bill WHERE bill.b_date ='".$date."' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}


	public function countBillPaid(){
		$sql = "SELECT * FROM bill WHERE bill.payment_status = 'PAID'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount(); 
		return $results;
	}

	public function countBillCredited(){
		$sql = "SELECT * FROM bill WHERE bill.payment_mode = 'CREDIT'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}


	public function editBill($b_reference,$payment_mode){
		$sql = "UPDATE  bill  SET bill.payment_mode = '".$payment_mode."' WHERE  bill.b_reference = '".$b_reference."' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		
	}
	


}





 ?>