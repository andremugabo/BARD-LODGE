<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/ProductImages.php');

class ProductImagesDao extends db {
    public function createImage(ProductImages $images){
        $p_id = $images->getPId();
        $pi_name = $images->getPiImage();

        $query = "INSERT INTO product_image(p_id,pi_name) VALUES(?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_id,
            $pi_name
        ));
        return $result;
    }

    public function checkIfImageExist(ProductImages $images){
        $p_id = $images->getPId();
        $query = "SELECT * FROM product_image WHERE p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function updateImage(ProductImages $images){
        $pi_name = $images->getPiImage();
        $pi_id = $images->getPiId();
        $p_id = $images->getPId();
        $query = "UPDATE product_image SET pi_name = ?  WHERE pi_id = ? AND p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $pi_name,
            $pi_id,
            $p_id
        ));

    }


    public function selectImages(){
        $query = "SELECT products.*,product_image.* FROM product_image JOIN products 
        ON product_image.p_id = products.p_id WHERE products.p_status = '1'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    
}



?>