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



    public function checkIfCategoryExistByPcId(Products $products)
    {
        $pc_id = $products->getPcId();
        $query = "SELECT  *  FROM products WHERE products.pc_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pc_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function getProductsById(Products $products)
    {
        $p_id = $products->getPId();
        $query = "SELECT product_category.*,unity.*,products.* FROM products JOIN product_category 
        ON products.pc_id = product_category.pc_id  JOIN unity 
        ON products.unity_id = unity.unity_id WHERE products.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id,
        ));
        $result = $statement->fetch();
        return $result;
    }


    public function selectProducts() {
        $query = "SELECT product_category.*,unity.*,products.* FROM products JOIN product_category 
        ON products.pc_id = product_category.pc_id  JOIN unity 
        ON products.unity_id = unity.unity_id WHERE products.p_status = '1' ";
        
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }


    public function selectProductsByFilter($productByFilter) {
        $query = "SELECT product_category.*,unity.*,products.* FROM products JOIN product_category 
        ON products.pc_id = product_category.pc_id  JOIN unity 
        ON products.unity_id = unity.unity_id WHERE products.p_status = '1' $productByFilter ";
        
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }

    public function selectProductsByCategory(Products $products) {
        $pc_id = $products->getPcId();
        $query = "SELECT product_category.*,unity.*,products.* FROM products JOIN product_category 
        ON products.pc_id = product_category.pc_id  JOIN unity 
        ON products.unity_id = unity.unity_id WHERE products.p_status = '1' AND products.pc_id = ? ";
        
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pc_id,
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }

    public function selectSideDishesProducts() {
        $query = "SELECT product_category.*,unity.*,products.* FROM products JOIN product_category 
        ON products.pc_id = product_category.pc_id  JOIN unity 
        ON products.unity_id = unity.unity_id WHERE products.p_status = '1' AND products.p_sidedishes = '1' ";
        
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }


    public function countProduct()
    {
        $query = "SELECT  *  FROM products";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->rowCount();
        return $result;
    }


    public function updateProducts(Products $products) {
        $pc_id = $products->getPcId();
        $p_name = $products->getPName();
        $unity_id = $products->getUnityId();
        $p_id = $products->getPId();

        $query = "UPDATE products SET  pc_id = ?, p_name = ?, unity_id = ? WHERE products.P_ID = ?";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $pc_id,
            $p_name,
            $unity_id,
            $p_id
        ));
        return $result;
    }


    public function checkIfExistProductsWithSideDishes(Products $products) {
        $p_id = $products->getPId();
        $query = "SELECT * FROM products   WHERE p_sidedishes = '1' AND products.P_ID = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function productsWithSideDishes(Products $products) {
        $p_id = $products->getPId();
        $query = "UPDATE products SET  p_sidedishes = '1' WHERE products.P_ID = ?";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $p_id
        ));
        return $result;
    }

    public function disableProductsWithSideDishes(Products $products) {
        $p_id = $products->getPId();
        $query = "UPDATE products SET  p_sidedishes = '0' WHERE products.P_ID = ?";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $p_id
        ));
        return $result;
    }

    





}


?>