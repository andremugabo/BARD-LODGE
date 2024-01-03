<?php 
require_once"db.php";
class categoryModel extends db{

	public function selectActive(){
		$sql = "SELECT * FROM category WHERE category.cat_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute();

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}

	public function insert($cat_name){
		$sql = "INSERT INTO category(cat_name) VALUES(?) ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$cat_name
		));
	}


	public function checkInsert($cat_name){
		$sql = "SELECT * FROM category WHERE category.cat_name = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$cat_name
		));
		$result = $statement->rowCount();
		return $result;
	}

	public function checkCategoryExist($cat_id){
		$sql = "SELECT * FROM category WHERE category.cat_id = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$cat_id
		));
		$result = $statement->rowCount();
		return $result;
	}

	public function checkCategoryExistD($pd_id){
		$sql = "SELECT * FROM category WHERE category.pd_id = ?";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$pd_id
		));
		$result = $statement->rowCount();
		return $result;
	}

	public function selectOneD($pd_id){
		$sql = "SELECT * FROM category WHERE category.pd_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$pd_id

		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}


	public function selectOne($cat_id){
		$sql = "SELECT * FROM category WHERE category.cat_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$cat_id

		));

		$result = $statement->fetch();
		return $result;
	}
}



 ?>