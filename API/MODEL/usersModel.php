<?php 
// session_start();
require_once"db.php";
class usersModel extends db{

	public function selectActive(){
		$sql = "SELECT employee.e_id,employee.e_role,employee.e_names,employee.e_status,users.* FROM users JOIN employee ON users.e_id = employee.e_id WHERE (employee.e_status = '1' AND users.u_status = '1') ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectAll(){
		$sql = "SELECT employee.*,users.* FROM users JOIN employee ON users.e_id = employee.e_id WHERE (employee.e_status = '1' AND users.u_status = '1') ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function selectLogin($username,$password){
		$sql = "SELECT * FROM users WHERE users.u_name = ? AND users.u_password = ? AND users.u_status ='1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$username,
			$password
		));
		$result = $statement->fetch();
		return $result;
	}


	public function login($username,$password){
		$sql = "SELECT * FROM users WHERE users.u_name = ? AND users.u_password = ? AND users.u_status ='1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$username,
			$password
		));
		$result = $statement->rowCount();
		return $result;
	}

	public function countUser(){
		$sql = "SELECT * FROM users WHERE  users.u_status ='1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();
		$result = $statement->rowCount();
		return $result;
	}


	public function checkPassword($password){
		$sql = "SELECT * FROM users WHERE  users.u_password = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$password
		));
		$result = $statement->rowCount();
		return $result;
	}

	public function selectOne($id){
		$sql = "SELECT * FROM users WHERE users.e_id = ? AND users.u_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$id
		));
		$result = $statement->fetch();
		return $result;
	}


	public 	function selectRole($e_id){
		$sql = "SELECT e_role FROM 	employee WHERE employee.e_id = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$e_id
		));
		$result = $statement->fetch();
		return $result;
	}


	public function insertUser($e_id,$u_name,$u_password){
		$sql = "INSERT INTO users(e_id,u_name,u_password)  VALUES(?,?,?)";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

				$e_id,
				$u_name,
				$u_password
		));
		

	}


	public function deleteUser($e_id){
		$sql = "UPDATE  users SET u_status = '0' WHERE users.e_id = ?" ;
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

				$e_id
				
		));
		

	}


	public function updateUsername($u_name,$e_id){
		$sql = "UPDATE  users SET u_name = ? WHERE users.e_id = ?" ;
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

				$u_name,
				$e_id
				
		));
		

	}

	public function updatePassword($u_password,$e_id){
		$sql = "UPDATE  users SET u_password = ? WHERE users.e_id = ?" ;
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

				$u_password,
				$e_id
				
		));
		

	}
    
    public function checkActiveUser($id){
    	$sql = "SELECT * FROM users WHERE users.e_id = ?";
    	$statement = $this->connect()->prepare($sql);
    	$statement->execute(array(
    		$id
    	));

    	$result = $statement->rowCount();
    	return $result;
    }

	public function directLink($variables){
		$e_id = $_SESSION['logged_user']['e_id'];
		require_once"../MODEL/employeeModel.php";
		$employee = new employeeModel();
		$employeeData = $employee->selectOne($e_id);
		$E_role = $employeeData['e_role'];

		if ($E_role == "MD") {
			header("location:../../USERS/MD/$variables");
		} elseif ($E_role == "MANAGER") {
			header("location:../../USERS/MANAGER/$variables");
		}elseif ($E_role == "CASHIER") {
			header("location:../../USERS/CASHIER/$variables");
		}elseif ($E_role == "WAITER") {
			header("location:../../USERS/WAITER/$variables");
		}else {
			session_destroy();
			header("location:../../");
		} 
		
	}

}

// $user = new usersModel();

// var_dump($user->selectActive());

 ?>