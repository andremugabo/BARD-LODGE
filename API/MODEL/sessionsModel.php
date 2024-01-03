<?php 
require_once"db.php";
class sessionsModel extends db{ 

	public function selectAll(){
		$sql = "SELECT employee.*,session.* FROM session JOIN employee ON employee.e_id = session.e_id  ORDER BY s_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		while ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $result;
		}
	}

    public function selectActive(){
		$sql = "SELECT session.*,employee.* FROM session JOIN employee ON session.e_id = employee.e_id WHERE session.s_status = 'Open'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		while ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $result; 
		}
	}

	 public function selectOpen(){
		$sql = "SELECT session.*,employee.* FROM session JOIN employee ON session.e_id = employee.e_id WHERE session.s_status = 'Open'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$result = $statement->fetch();
		return $result;
	}

    public function selectClosed(){
		$sql = "SELECT session.*,employee.* FROM session JOIN employee ON session.e_id = employee.e_id WHERE session.s_status = 'Closed' ORDER BY s_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		while ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $result;
		}
	}

	public function checkInsert($s_reference){
		$sql = "SELECT * FROM session WHERE session.s_reference = '$s_renference'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$s_reference
		));
		$result = $statement->rowCount();
		return $result;
	}

	public function checkOpen(){
		$sql = "SELECT * FROM session WHERE  session.s_status = 'Open'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$result = $statement->rowCount();
		return $result;
	}


	public function insert($e_id,$s_reference){
		$sql = "INSERT INTO session(e_id,s_reference) VALUES(?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id,
			$s_reference
		));
	}

    public function close($s_id){
		$sql = "UPDATE session SET  s_status='Closed' WHERE session.s_id =?  ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$s_id,
			
		));
	}


	public function countSession(){
		$sql = "SELECT * FROM session";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}
}



 ?>