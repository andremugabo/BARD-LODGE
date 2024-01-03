<?php 
require_once"db.php";
class pDescriptionModel extends db{

	public function selectActive(){
		$sql = "SELECT * FROM productsdescription WHERE productsdescription.pd_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function insert($pd_name){
		$sql = "INSERT INTO productsdescription(cat_name) VALUES(?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$pd_name
		));
	}


	public function checkInsert($pd_name){
		$sql = "SELECT * FROM productsdescription WHERE productsdescription.pd_name = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$pd_name
		));
		$result = $statement->rowCount();
		return $result;
	}
}



 ?>