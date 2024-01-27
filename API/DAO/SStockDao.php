<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/SStock.php');

class SStockDao extends db{

    public function createSStock(SStock $SStock){
        $s_ref = $SStock->getSId();
        $p_id = $SStock->getPId();
        // $p_qty = $SStock->getPQty();
        $query = "INSERT INTO s_stock(s_id,p_id) VALUES(?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_ref,
            $p_id
            // $p_qty
        ));
        return $result;
    }


    public function countItem(){
        $query = "SELECT sum(p_qty) FROM s_stock";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    public function checkIfProductExistSStock(SStock $SStock){
        $p_id = $SStock->getPId();
        $query = "SELECT * FROM s_stock WHERE p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function selectProductQty(SStock $SStock){
        $p_id = $SStock->getPId();
        $query = "SELECT p_qty FROM s_stock  WHERE s_stock.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->fetch();
            return $result;    
    }






    public function updateProductQty(SStock $SStock){
        $p_qty = $SStock->getPQty();
        $p_pprice = $SStock->getPPrice();
        $p_id = $SStock->getPId();
        $query = "UPDATE s_stock SET p_qty = ?,p_pprice = ? WHERE s_stock.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_qty,
            $p_pprice,
            $p_id
        ));
        return $result;
    }

    public function selectSStock(){
        $query = "SELECT sessions.*,products.*,s_stock.* FROM s_stock JOIN sessions ON 
        sessions.s_id = s_stock.s_id JOIN products ON products.p_id = s_stock.p_id";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    public function selectSStockById(SStock $SStock){
        $p_id = $SStock->getPId();
        $query = "SELECT sessions.*,products.*,s_stock.* FROM s_stock JOIN sessions ON 
        sessions.s_id = s_stock.s_id JOIN products ON products.p_id = s_stock.p_id WHERE s_stock.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->fetch();
        return $result;
        
    }


    public function selectSStockByFilter($productByFilter){
        $query = "SELECT sessions.*,products.*,s_stock.* FROM s_stock JOIN sessions ON 
        sessions.s_id = s_stock.s_id JOIN products ON products.p_id = s_stock.p_id  $productByFilter ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }











}





?>