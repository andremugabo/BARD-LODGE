<?php
require_once 'db.php';
require_once (__DIR__.'/../MODEL/ProductCategory.php');


class ProductCategoryDao extends db{
    public function createCategory(ProductCategory $productCategory) {
        $pt_id = $productCategory->getPtId();
        $pc_name = $productCategory->getPcName();

        $query = "INSERT INTO product_category (pt_id,pc_name) VALUES (?,?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $pt_id,
            $pc_name            
        ));
        return $result;
    }

    public function updateCategory(ProductCategory $productCategory) {
        $pc_id = $productCategory->getPcId();
        $pc_name = $productCategory->getPcName();

        $query = "UPDATE  product_category  SET  pc_name = ? WHERE pc_id = ?";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $pc_name,
            $pc_id            
        ));
        return $result;
    }
    
    

    public function checkIfCategoryExist(ProductCategory $productCategory)
    {
        $pc_name = $productCategory->getPcName();
        $query = "SELECT  *  FROM product_category WHERE product_category.pc_name = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pc_name
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function checkIfCategoryExistById(ProductCategory $productCategory)
    {
        $pc_id = $productCategory->getPcId();
        $query = "SELECT  *  FROM product_category WHERE product_category.pc_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pc_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function checkIfCategoryExistByPId(ProductCategory $productCategory)
    {
        $pt_id = $productCategory->getPtId();
        $query = "SELECT  *  FROM product_category WHERE product_category.pt_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pt_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function selectProductCategory() {
        $query = "SELECT product_type.*,product_category.* FROM product_category JOIN product_type 
        ON product_type.pt_id = product_category.pt_id ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }


    public function selectProductCategoryByPcId(ProductCategory $productCategory) {
        $pc_id = $productCategory->getPcId();
        $query = "SELECT * FROM product_category WHERE product_category.pc_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pc_id,
        ));
       $result = $statement->fetch();
            return $result;
    }

    public function selectOneType(ProductCategory $productCategory){
        $pt_id = $productCategory->getPtId();
		$sql = "SELECT * FROM product_category WHERE product_category.pt_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$pt_id
		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
			return $result;
		}
	}



}










?>