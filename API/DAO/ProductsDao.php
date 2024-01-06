<?php
require_once 'db.php';
require_once (__DIR__.'/../MODEL/Products.php');


class ProductsDao extends db{
    public function createProduct(Products $products) {
        $p_code = $products->getPCode();
        $pc_id = $products->getPcId();
        $p_name = $products->getPName();
        $unity_id = $products->getUnityId();


        $query = "INSERT INTO products (p_code,pc_id,p_name,unity_id) VALUES (?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $p_code,
            $pc_id,            
            $p_name,            
            $unity_id            
        ));
        return $result;
    }



    public function checkIfProductExist(Products $products)
    {
        $p_name = $products->getPName();
        $query = "SELECT  *  FROM products WHERE products.p_name = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_name
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function checkIfCategoryExistById(Products $products)
    {
        $p_id = $products->getPId();
        $query = "SELECT  *  FROM products WHERE products.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function selectProducts() {
        $query = "SELECT * FROM products WHERE products.p_status = '1' ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }

    





}


?>