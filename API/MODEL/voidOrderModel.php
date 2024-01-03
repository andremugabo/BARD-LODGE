<?php 
require_once"db.php";
class voidOrderModel extends db{

	public function selectAll(){
		$sql = "SELECT orders.*,products.*,employee.*,void_orders.* FROM void_orders JOIN orders ON orders.o_reference = void_orders.o_reference JOIN employee ON employee.e_id = void_orders.e_id JOIN products ON products.p_id = void_orders.p_id ORDER BY vo_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectE_id($e_id){
		$sql = "SELECT orders.*,products.*,employee.*,void_orders.* FROM void_orders JOIN orders ON orders.o_reference = void_orders.o_reference JOIN employee ON employee.e_id = void_orders.e_id JOIN products ON products.p_id = void_orders.p_id WHERE void_orders.e_id = ? ORDER BY vo_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id
		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

    public function insert($o_reference,$e_id,$p_id,$vo_quantity){
		$sql = "INSERT INTO void_orders(o_reference,e_id,p_id,vo_quantity) VALUES(?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$o_reference,
			$e_id,
            $p_id,
            $vo_quantity
            
		));
     
		
	}


	public function checkProductExist($o_reference,$p_id){
		$sql = "SELECT o_reference, p_id FROM void_orders WHERE o_reference = ? AND p_id = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$o_reference,
			$p_id
		));
		$result = $statement->rowCount();
		return $result;
	}


	public function selectOne($o_reference,$p_id){
		$sql = "SELECT void_orders.* FROM void_orders WHERE o_reference = ? AND p_id = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$o_reference,
			$p_id
		));
		$result = $statement->fetch();
		return $result;
	}
	

	 public function updateQty($vo_quantity,$o_reference,$p_id){
		$sql = "UPDATE void_orders SET vo_quantity = ? WHERE o_reference = ? AND p_id = ?  ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			
			$vo_quantity,
			$o_reference,
            $p_id
            
            
		));
     
		
	}

	// public function selectNPaid(){
	// 	$sql = " SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();

	// 	while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
	// 		return $result;
	// 	}
	// }


	// public function selectNPaidEmployee(){
	// 	$sql = " SELECT DISTINCT(orders.e_id,orders.o_payment) , employee.*,subsession.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();

	// 	while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
	// 		return $result;
	// 	}
	// }

	// public function selectPaid(){
	// 	$sql = " SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'PAID' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();

	// 	while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
	// 		return $result;
	// 	}
	// }

	// public function selectOne($e_id){
	// 	$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' AND employee.e_id =? AND employee.e_status = '1' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$e_id

	// 	));

	// 	$result = $statement->fetch();
	// 	return $result;
	// }

	// public function selectEmployee($e_id){
	// 	$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' AND employee.e_id =? AND employee.e_status = '1' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$e_id

	// 	));

	// 	while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
	// 		return $result;
	// 	}
	// }


	// public function selectOref($o_reference){
	// 	$sql = "SELECT employee.*,subsession.*,orders.* FROM orders JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_reference =? ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$o_reference

	// 	));

	// 	$result = $statement->fetch();
	// 	return $result;
	// }


	

	// public function checkorderExist($o_reference){
	// 	$sql = "SELECT o_reference FROM orders WHERE orders.o_reference = ? ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(
	// 		$o_reference
	// 	));
	// 	$result = $statement->rowCount();
	// 	return $result;
	// }



	// public function checkEmployeeExist($e_id){
	// 	$sql = "SELECT e_id FROM orders WHERE orders.e_id = ? ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(
	// 		$e_id
	// 	));
	// 	$result = $statement->rowCount();
	// 	return $result;
	// }



	

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

	


}





 ?>