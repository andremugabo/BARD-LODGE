<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/ReceivedProducts.php');

class ReceivedProductsDao extends db{
    public function createReceived(ReceivedProducts $Received){
        $s_id = $Received->getSId();
        $p_id = $Received->getPId();
        $p_pprice = $Received->getPPrice();
        $qty_rec = $Received->getQtyRec();
        $query = "INSERT INTO received(s_id,p_id,p_pprice,qty_rec) VALUES(?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_id,
            $p_id,
            $p_pprice,
            $qty_rec
        ));
        return $result;
    }

    public function checkIfProductExistInSession(ReceivedProducts $Received){
        $p_id = $Received->getPId();
        $s_id = $Received->getSId();
        $query = "SELECT * FROM received WHERE p_id = ? AND s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id,
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }


    

    public function selectProductQty(ReceivedProducts $Received){
        $p_id = $Received->getPId();
        $s_id = $Received->getSId();
        $query = "SELECT qty_rec FROM received  WHERE received.p_id = ? AND received.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id,
            $s_id
        ));
        $result = $statement->fetch();
            return $result;    
    }

    public function updateProductQty(ReceivedProducts $Received){
        $qty_rec = $Received->getQtyRec();
        $p_id = $Received->getPId();
        $s_id = $Received->getSId();
       
        $query = "UPDATE received SET qty_rec = ? WHERE received.p_id = ? AND received.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $qty_rec,
            $p_id,
            $s_id
        ));
        return $result;
    }

    public function selectReceived(){
        $query = "SELECT sessions.*,products.*,received.* FROM received JOIN sessions ON 
        sessions.s_id = received.s_id JOIN products ON products.p_id = received.p_id";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }

    public function selectReceivedBySId(ReceivedProducts $Received){
        $s_id = $Received->getSId();
        $query = "SELECT sessions.*,products.*,received.* FROM received JOIN sessions ON 
        sessions.s_id = received.s_id JOIN products ON products.p_id = received.p_id WHERE received.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    public function selectReceivedByFilter($productByFilter){
        $query = "SELECT sessions.*,products.*,received.* FROM received JOIN sessions ON 
        sessions.s_id = received.s_id JOIN products ON products.p_id = received.p_id  $productByFilter ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }

    public function selectReceivedByFilterAndSession($productByFilter,ReceivedProducts $Received){
        $s_id = $Received->getSId();
        $query = "SELECT sessions.*,products.*,received.* FROM received JOIN sessions ON 
        sessions.s_id = received.s_id JOIN products ON products.p_id = received.p_id WHERE received.s_id = ?  $productByFilter ";
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