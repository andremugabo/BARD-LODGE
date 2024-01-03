<?php 
require_once"db.php";
class billDetailsModel extends db{

	public function selectRef($b_reference){
		$sql = "SELECT bill.*,products.*,bill_details.* FROM bill_details JOIN bill ON bill.b_reference = bill_details.b_reference JOIN products ON products.p_id = bill_details.p_id WHERE bill_details.b_reference = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $b_reference
        ));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}


	public function selectRefKitcken($b_reference){
		$sql = "SELECT bill.*,products.*,productsdescription.*,bill_details.* FROM bill_details JOIN bill ON bill.b_reference = bill_details.b_reference JOIN products ON products.p_id = bill_details.p_id JOIN productsdescription ON productsdescription.pd_id = bill_details.pd_id WHERE bill_details.b_reference = ? AND bill_details.pd_id = '3' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $b_reference
        ));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectNPaid(){
		$sql = " SELECT bill.*,products.*,bill_details.* FROM bill_details JOIN bill ON bill.b_reference = bill_detatils.b_reference JOIN products ON products.p_id = bill_details.p_id WHERE bill.payment_status = 'NOT PAID' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectPaid(){
		$sql = " SELECT bill.*,products.*,bill_details.* FROM bill_details JOIN bill ON bill.b_reference = bill_detatils.b_reference JOIN products ON products.p_id = bill_details.p_id WHERE bill.payment_status = 'NOT PAID' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	// public function selectOne($e_id){
	// 	$sql = "SELECT employee.*,subsession.*,bill.* FROM bill JOIN employee ON  employee.e_id = orders.e_id JOIN subsession ON subsession.sub_id = orders.sub_id WHERE orders.o_payment = 'NOT PAID' AND employee.e_id =? AND employee.e_status = '1' ";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(

	// 		$e_id

	// 	));

	// 	$result = $statement->fetch();
	// 	return $result;
	// }


	

	// public function checkorderExist($o_reference,$p_id){
	// 	$sql = "SELECT o_reference,p_id FROM order_details WHERE order_details.o_reference = ? AND order_details.p_id = ?";
	// 	$statement = $this->connect()->prepare($sql);
	// 	$statement->execute(array(
	// 		$o_reference,
    //         $p_id
	// 	));
	// 	$result = $statement->rowCount();
	// 	return $result;
	// }



	public function insert($b_reference,$p_id,$pd_id,$bd_quantity,$bd_bprice,$bd_sprice,$sessionDate){
		$sql = "INSERT INTO bill_details(b_reference,p_id,pd_id,bd_quantity,bd_bprice,bd_sprice,bd_date) VALUES(?,?,?,?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$b_reference,
			$p_id,
			$pd_id,
            $bd_quantity,
            $bd_bprice,
            $bd_sprice,
			$sessionDate
            
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



	public function selectByDate($bd_date){
		$sql = "SELECT bill.*,products.*,bill_details.* FROM bill_details JOIN bill ON bill.b_reference = bill_details.b_reference JOIN products ON products.p_id = bill_details.p_id WHERE bill_details.bd_date = ? AND bill.sub_type = 'NORMAL'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $bd_date
        ));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}



	public function selectByDateVip($bd_date){
		$sql = "SELECT bill.*,products.*,bill_details.* FROM bill_details JOIN bill ON bill.b_reference = bill_details.b_reference JOIN products ON products.p_id = bill_details.p_id WHERE bill_details.bd_date = ? AND bill.sub_type = 'VIP'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $bd_date
        ));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}
	



	public function selectDistinctDate(){
		$sql = "SELECT DISTINCT(bill_details.bd_date) FROM bill_details  ORDER BY bill_details.bd_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}


}





 ?>