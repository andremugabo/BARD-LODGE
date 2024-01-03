<?php 
require_once"db.php";
class orderDetailsModel extends db{

	public function selectRef($o_reference){
		$sql = "SELECT orders.*,products.*,order_details.* FROM order_details JOIN orders ON orders.o_reference = order_details.o_reference JOIN products ON products.p_id = order_details.p_id WHERE order_details.o_reference = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $o_reference
        ));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}


	public function selectRefForKitchen($o_reference){
		$sql = "SELECT orders.*,products.*,productsdescription.*,order_details.* FROM order_details JOIN orders ON orders.o_reference = order_details.o_reference JOIN products ON products.p_id = order_details.p_id JOIN productsdescription ON productsdescription.pd_id = order_details.pd_id WHERE order_details.o_reference = ? AND order_details.pd_id = '3' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $o_reference
        ));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectNPaid(){
		$sql = " SELECT orders.*,products.*,order_details.* FROM order_details JOIN orders ON orders.o_reference = order_detatils.o_reference JOIN products ON products.p_id = order_details.p_id WHERE orders.o_payment = 'NOT PAID' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectPaid(){
		$sql = " SELECT orders.*,products.*,order_details.* FROM order_details JOIN orders ON orders.o_reference = order_detatils.o_reference JOIN products ON products.p_id = order_details.p_id WHERE orders.o_payment = 'PAID' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

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


	

	public function checkorderExist($o_reference,$p_id){
		$sql = "SELECT o_reference,p_id FROM order_details WHERE order_details.o_reference = ? AND order_details.p_id = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$o_reference,
            $p_id
		));
		$result = $statement->rowCount();
		return $result;
	}



	public function delete($o_reference,$p_id){
		$sql = "DELETE FROM order_details WHERE order_details.o_reference = ? AND order_details.p_id = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$o_reference,
            $p_id
		));
	}



	public function insert($o_reference,$p_id,$pd_id,$od_quantity,$p_price,$s_price,$orderdate){
		$sql = "INSERT INTO order_details(o_reference,p_id,pd_id,od_quantity,p_price,s_price,od_date) VALUES(?,?,?,?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$o_reference,
			$p_id,
			$pd_id,
            $od_quantity,
            $p_price,
            $s_price,
			$orderdate
            
		));
     
		
	}

    public function updateQty($od_quantity,$o_reference,$p_id){
		$sql = "UPDATE order_details SET od_quantity = ? WHERE o_reference=? AND p_id=? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$od_quantity,
            $o_reference,
			$p_id
		));
     
		
	}

     public function selectProduct($o_reference,$p_id){
		$sql = "SELECT * FROM order_details WHERE order_details.o_reference=? AND order_details.p_id=? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$o_reference,
			$p_id
		));
        $result = $statement->fetch();
		return $result;		
	}

	// public function countOrder(){
	// 	$sql = "SELECT * FROM orders";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute();
	// 	$results = $statement->rowCount();
	// 	return $results;
	// }

		public function selectBarProduct($where,$bydate,$bypd_id,$byeid){
		$sql = "SELECT products.*,orders.*,productsdescription.*,order_details.* FROM order_details JOIN products ON products.p_id=order_details.p_id JOIN orders ON orders.o_reference = order_details.o_reference JOIN productsdescription ON productsdescription.pd_id = order_details.pd_id ".$where.$bydate.$bypd_id.$byeid."  ORDER BY order_details.o_reference DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}	
	}



	public function selectByDate($od_date){
		$sql = "SELECT orders.*,products.*,order_details.* FROM order_details JOIN orders ON orders.o_reference = order_details.o_reference JOIN products ON products.p_id = order_details.p_id WHERE order_details.od_date = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $od_date
        ));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectDistinctDate(){
		$sql = "SELECT DISTINCT(order_details.od_date) FROM order_details  ORDER BY order_details.od_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	


}





 ?>