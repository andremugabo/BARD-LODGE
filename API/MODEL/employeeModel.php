<?php 
require_once"db.php";
class employeeModel extends db{


	// METRIC START

	public function selecTMetricActive($where,$bydate,$byeid){
		$sql = "SELECT employee.*,metric.* FROM metric JOIN  employee  ON employee.e_id = metric.e_id ".$where.$bydate.$byeid."  metric.m_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}





	// METRIC END
	public function selectActive(){
		$sql = "SELECT * FROM employee WHERE employee.e_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectAll(){
		$sql = " SELECT * FROM employee ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function countEmployee(){
		$sql = " SELECT * FROM employee ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		$result = $statement->rowCount();
		return $result;
	}

	public function selectOne($id){
		$sql = "SELECT * FROM employee WHERE employee.e_id =? AND employee.e_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$id

		));

		$result = $statement->fetch();
		return $result;
	}


	public function edit($e_names,$e_role,$e_email,$e_phone,$e_id){
		$sql = "UPDATE  employee SET e_names=?,e_role=?,e_email=?,e_phone=? WHERE employee.e_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			
			$e_names,
			$e_role,
			$e_email,
			$e_phone,
			$e_id

		));
		
	}


	public function checkEmployeeExist($e_email,$e_phone){
		$sql = "SELECT e_email,e_phone FROM employee WHERE employee.e_email = ? OR employee.e_phone = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_email,
			$e_phone
		));
		$result = $statement->rowCount();
		return $result;
	}



	public function insert($e_regnumber,$e_names,$e_role,$e_email,$e_phone){
		$sql = "INSERT INTO employee(e_regnumber,e_names,e_role,e_email,e_phone) VALUES(?,?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$e_regnumber,
			$e_names,
			$e_role,
			$e_email,
			$e_phone
		));
     
		
	}

	


}





 ?>