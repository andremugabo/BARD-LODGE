<?php 
require_once"db.php";
class ordersModel extends db{

	// public function selectActive(){
	// 	$sql = "SELECT * FROM employee WHERE employee.e_status = '1' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();

	// 	while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
	// 		return $result;
	// 	}
	// }

	public function selectNPaid(){
		$sql = " SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' AND orders.o_status = '1' ORDER BY orders.o_reference DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectNPaidE_id($e_id){
		$sql = " SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' AND orders.e_id = ? AND orders.o_status = '1' ORDER BY orders.o_reference DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id
		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectOne($e_id){
		$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' AND employee.e_id =? AND employee.e_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$e_id

		));

		$result = $statement->fetch();
		return $result;
	}


	// public function selectNPaidEmployee(){
	// 	$sql = " SELECT DISTINCT(orders.e_id,orders.o_payment) , employee.*,subsession.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();

	// 	while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
	// 		return $result;
	// 	}
	// }

	public function selectPaid(){
		$sql = " SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'PAID' AND orders.o_status = '1' ORDER BY orders.o_reference DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectPaidE_id($e_id){
		$sql = " SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'PAID' AND orders.e_id = ? AND orders.o_status = '1' ORDER BY orders.o_reference DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id
		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	

	public function selectEmployee($e_id){
		$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' AND employee.e_id =? AND employee.e_status = '1' AND orders.o_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$e_id

		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}


	public function selectOref($o_reference){
		$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_reference =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$o_reference

		));

		$result = $statement->fetch();
		return $result;
	}


	public function selectWaiter($e_id,$o_date){
		$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.e_id =? AND orders.o_date=? AND orders.o_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$e_id,
			$o_date

		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}



	public function selectWaiterN($e_id,$o_date){
		$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.e_id =? AND orders.o_date=? AND subsession.sub_type = 'NORMAL' orders.o_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$e_id,
			$o_date

		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}



	public function selectWaiterV($e_id,$o_date){
		$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.e_id =? AND orders.o_date=? AND subsession.sub_type = 'VIP' AND orders.o_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$e_id,
			$o_date

		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	

	public function checkorderExist($o_reference){
		$sql = "SELECT o_reference FROM orders WHERE orders.o_reference = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$o_reference
		));
		$result = $statement->rowCount();
		return $result;
	}



	public function checkEmployeeExist($e_id){
		$sql = "SELECT e_id FROM orders WHERE orders.e_id = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id
		));
		$result = $statement->rowCount();
		return $result;
	}



	public function insert($sub_id,$o_reference,$e_id,$o_date){
		$sql = "INSERT INTO orders(sub_id,o_reference,e_id,o_date) VALUES(?,?,?,?) "; 
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$sub_id,
			$o_reference,
			$e_id,
			$o_date
            
		));
     
		
	}

	public function updateAmount($o_payment,$o_amount,$o_reference){
		$sql = "UPDATE  orders SET o_payment = ? , o_amount = ? WHERE o_reference = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$o_payment,
			$o_amount,
			$o_reference			
            
		));    
		
	}

	public function countOrder(){
		$sql = "SELECT * FROM orders";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}



	public function countOrderByEmployee($e_id,$o_date){
		$sql = "SELECT * FROM orders WHERE orders.e_id ='".$e_id."' AND orders.o_date = '".$o_date."' ORDER BY o_date DESC"; 
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}

	


}





 ?>