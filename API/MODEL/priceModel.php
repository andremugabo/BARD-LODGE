<?php 
require_once"db.php";

class priceModel extends db {


	public function insert($p_id,$purchase_price,$price_normal,$price_vip){
		$sql = "INSERT INTO price_s(p_id,purchase_price,price_normal,price_vip) VALUES(:p_id,:purchase_price,:price_normal,:price_vip)";
		$statement = $this->connect()->prepare($sql);
		$statement ->execute(array(

			":p_id"=>$p_id,
            ":purchase_price"=>$purchase_price,
			":price_normal"=>$price_normal,
			":price_vip"=>$price_vip

		));
	}


    public function update($p_id){
		$sql = "UPDATE  price_s SET price_s.price_status = '0' WHERE price_s.p_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$p_id

		));
		
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

	public function checkIfExist($p_id){
		$sql = "SELECT * FROM price_s WHERE price_s.p_id = ? AND price_s.price_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$p_id
           
		));

		$results = $statement->rowCount();
		return $results;
	}


	public function getProduct($cat_id){
		$sql = "SELECT * FROM products WHERE products.cat_id = ? AND products.p_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$cat_id
		));

		while($results = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $results;
		}
	}


	public function selectActive(){
		$sql = "SELECT products.p_id,products.p_status,products.p_name,price_s.* FROM price_s JOIN products ON price_s.p_id = products.p_id WHERE price_s.price_status = '1' AND products.p_status = '1'";
		$statement = $this->connect()->prepare($sql);
		$statement ->execute();

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) { 
			return $results;
		}
	}

    public function selectOne($p_id){
		$sql = "SELECT products.*,price_s.* FROM price_s JOIN products ON price_s.p_id = products.p_id WHERE price_s.p_id = ? AND price_s.price_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$p_id

		));

		$result = $statement->fetch();
		return $result;
	}

    public function checkIfproductExistCat_id($cat_id){
		$sql = "SELECT products.*,price_s.* FROM price_s JOIN  products ON products.p_id = price_s.p_id WHERE products.cat_id = :cat_id ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			":cat_id" => $cat_id,
			
		));
		$results = $statement->rowCount();
		return $results;
	}

	public function selectOneCat($cat_id){
		$sql = "SELECT products.*,price_s.* FROM price_s  JOIN products ON products.p_id = price_s.p_id WHERE products.cat_id =? AND price_s.price_status = '1' ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(

			$cat_id

		));

		while ($results = $statement->fetchAll(PDO::FETCH_ASSOC)) {
			return $results;
		}	
	}

}




 ?>