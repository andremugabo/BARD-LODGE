<?php 
require_once"db.php";
class metricModel extends db{

	public function selectActive(){
		$sql = "SELECT * FROM metric WHERE metric.m_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectAll(){
		$sql = " SELECT * FROM metric ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectOne($id){
		$sql = "SELECT * FROM metric WHERE metric.e_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$id

		));

		$result = $statement->fetch();
		return $result;
	}



	public function insert($e_id,$m_action,$m_day,$m_date){
		$sql = "INSERT INTO metric(e_id,m_action,m_day,m_date) VALUES(?,?,?,?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            
            $e_id,
			$m_action,
            $m_day,
            $m_date
		));
     
		
	}

	


}





 ?>