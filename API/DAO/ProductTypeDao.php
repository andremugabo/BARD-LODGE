<?php  
require_once 'db.php';
require_once (__DIR__.'/../MODEL/ProductType.php');

class ProductTypeDao extends db{

    public function createProductType(ProductType $productType) {
        $pt_name = $productType->getPtName();
       

        $query = "INSERT INTO product_type (pt_name) VALUES (?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $pt_name
        ));
        return $result;
    }

    public function checkIfProductTypeExist(ProductType $productType)
    {
        $ptName = $productType->getPtName();

        $query = "SELECT  *  FROM product_type WHERE product_type.pt_name = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $ptName
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function checkIfProductTypeExistById(ProductType $productType)
    {
        $pt_id = $productType->getPtId();
        $query = "SELECT  *  FROM product_type WHERE product_type.pt_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pt_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function selectProductType() {
        $query = "SELECT * FROM product_type ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }


    public function selectProductTypeById(ProductType $productType) {
        $pt_id = $productType->getPtId();
        $query = "SELECT * FROM product_type WHERE product_type.pt_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pt_id
        ));
        
        $result = $statement->fetch();
        
            return $result;
        
        
        
    }



}




?>