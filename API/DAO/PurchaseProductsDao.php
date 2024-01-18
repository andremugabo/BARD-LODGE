<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/PurchaseProducts.php');

class PurchaseProductsDao extends db{
    public function createPurchase(PurchaseProducts $purchase){
        $s_id = $purchase->getSId();
        $p_id = $purchase->getPId();
        $qty_pur = $purchase->getQtyPur();
        $query = "INSERT INTO purchase(s_id,p_id,qty_pur) VALUES(?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_id,
            $p_id,
            $qty_pur
        ));
        return $result;
    }

    public function checkIfProductExistInSession(PurchaseProducts $purchase){
        $p_id = $purchase->getPId();
        $s_id = $purchase->getSId();
        $query = "SELECT * FROM purchase WHERE p_id = ? AND s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id,
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }


    

    public function selectProductQty(PurchaseProducts $purchase){
        $p_id = $purchase->getPId();
        $s_id = $purchase->getSId();
        $query = "SELECT qty_pur FROM purchase  WHERE purchase.p_id = ? AND purchase.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id,
            $s_id
        ));
        $result = $statement->fetch();
            return $result;    
    }

    public function updateProductQty(PurchaseProducts $purchase){
        $qty_pur = $purchase->getQtyPur();
        $p_id = $purchase->getPId();
        $s_id = $purchase->getSId();
       
        $query = "UPDATE purchase SET qty_pur = ? WHERE purchase.p_id = ? AND purchase.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $qty_pur,
            $p_id,
            $s_id
        ));
        return $result;
    }

    public function selectPurchase(){
        $query = "SELECT sessions.*,products.*,purchase.* FROM purchase JOIN sessions ON 
        sessions.s_id = purchase.s_id JOIN products ON products.p_id = purchase.p_id";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    public function selectPurchaseByFilter($productByFilter){
        $query = "SELECT sessions.*,products.*,purchase.* FROM purchase JOIN sessions ON 
        sessions.s_id = purchase.s_id JOIN products ON products.p_id = purchase.p_id  $productByFilter ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }

    public function selectPurchaseByFilterAndSession($productByFilter,PurchaseProducts $purchase){
        $s_id = $purchase->getSId();
        $query = "SELECT sessions.*,products.*,purchase.* FROM purchase JOIN sessions ON 
        sessions.s_id = purchase.s_id JOIN products ON products.p_id = purchase.p_id WHERE purchase.s_id = ?  $productByFilter ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }



}



?>