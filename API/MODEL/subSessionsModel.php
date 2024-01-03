<?php 
require_once"db.php";
class subSessionsModel extends db{

	public function selectAll(){
		$sql = "SELECT session.*,subsession.*  FROM subsession JOIN session ON session.s_reference = subsession.s_reference ORDER BY sub_date DESC";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		while ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $result;
		}
	}

    public function selectOpen(){
		$sql = "SELECT session.*,subsession.* FROM subsession JOIN session ON session.s_reference = subsession.s_reference WHERE session.s_status = 'Open'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		while ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $result;
		}
	}

    public function selectClosed(){
		$sql = "SELECT session.*,subsession.*  FROM subsession JOIN session ON session.s_reference = subsession.s_reference WHERE subsession.sub_status = 'Closed' ORDER BY s_date DESC ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		while ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $result;
		}
	}

	public function checkInsert($s_reference){
		$sql = "SELECT session.*,subsession.*  FROM subsession JOIN session ON session.s_reference = subsession.s_reference WHERE session.s_status = 'Open' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$s_reference
		));
		$result = $statement->rowCount();
		return $result;
	}

	public function checkVip($sub_reference){
		$sql = "SELECT * FROM subsession WHERE sub_reference = ? AND  subsession.sub_type = 'VIP'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(
            $sub_reference
        );
		$result = $statement->rowCount();
		return $result;
	}


    public function checkexist($s_reference){
		$sql = "SELECT * FROM subsession WHERE subsession.s_reference =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
             $s_reference
            ));          
        
		$result = $statement->rowCount();
		return $result;
	}

	public function selectSub($s_reference){
		$sql = "SELECT * FROM subsession WHERE subsession.s_reference =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
             $s_reference
            ));          
        
		$result = $statement->fetch();
		return $result;
	}

	public function insert($s_reference,$sub_reference,$sub_type){
		$sql = "INSERT INTO subsession(s_reference,sub_reference,sub_type) VALUES(?,?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$s_reference,
            $sub_reference,
            $sub_type
		));
	}

    public function vip($sub_id){
		$sql = "UPDATE subsession SET  sub_type='VIP' WHERE subsession.sub_id =?  ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$sub_id,
			
		));
	}


	public function countsubSession(){
		$sql = "SELECT * FROM subsession";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		return $results;
	}


	public function close($s_reference){
		$sql = "UPDATE subsession SET  sub_status='Closed' WHERE subsession.s_reference =?  ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$s_reference,
			
		));
	}

	public function Allclose(){
		$sql = "SELECT * FROM subsession WHERE sub_status='Closed'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$result = $statement->rowCount();
		return $result;
	}
}



 ?>