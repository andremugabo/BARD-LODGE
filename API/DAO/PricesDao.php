<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/Price.php');


class PricesDao extends db{
    public function checkProductPriceExists(Price $price){
        $p_id = $price->getPId();
        $unity_id = $price->getUnityId();
        $query = "SELECT * FROM prices WHERE prices.p_id = ? AND prices.unity_id = ? AND prices.price_status = '1'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id,
            $unity_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function createPrice(Price $price){
        $p_id = $price->getPId();
        $sPrice = $price->getSPrice();
        $ePrice = $price->getEPrice();
        $pPrice = $price->getPPrice();
        $unity_id = $price->getUnityId();
        $query = "INSERT INTO prices(p_id,sprice,eprice,pprice,unity_id) VALUE(?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_id,
            $sPrice,
            $ePrice,
            $pPrice,
            $unity_id
        ));
        return $result;
    }


    public function updatePrice(Price $price){
        $p_id = $price->getPId();
        $sPrice = $price->getSPrice();
        $ePrice = $price->getEPrice();
        $pPrice = $price->getPPrice();
        $unity_id = $price->getUnityId();
        $price_id = $price->getPriceId();
        $query = "UPDATE prices SET p_id = ?,sprice = ?,eprice = ?,pprice = ?,unity_id = ? WHERE prices.price_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_id,
            $sPrice,
            $ePrice,
            $pPrice,
            $unity_id,
            $price_id
        ));
        return $result;
    }

    public function selectPrice(){
        $query = "SELECT products.*,unity.*,prices.* FROM prices JOIN products 
        ON products.p_id = prices.p_id JOIN unity 
        ON unity.unity_id = prices.unity_id  WHERE prices.price_status = '1' AND products.p_status = '1'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }

    }


    public function selectPriceById(Price $price){
        $price_id = $price->getPriceId();
        $query = "SELECT products.*,unity.*,prices.* FROM prices JOIN products 
        ON products.p_id = prices.p_id JOIN unity 
        ON unity.unity_id = prices.unity_id  WHERE prices.price_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $price_id
        ));

        $result = $statement->fetch();
            return $result;
      

    }


    public function disablePrice(Price $price){
        $endDate = $price->getEndDate();
        $price_id = $price->getPriceId();

        $query = "UPDATE prices SET enddate = ?,price_status = '0' WHERE prices.price_id = ? ";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $endDate,
            $price_id
        ));
        return $result;
    }







}








?>