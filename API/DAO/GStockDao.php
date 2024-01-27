<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/GStock.php');

class GStockDao extends db{

    public function createGStock(GStock $gstock){
        $s_ref = $gstock->getSId();
        $p_id = $gstock->getPId();
        // $p_qty = $gstock->getPQty();
        $query = "INSERT INTO g_stock(s_id,p_id) VALUES(?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_ref,
            $p_id
            // $p_qty
        ));
        return $result;
    }


    public function countItem(){
        $query = "SELECT sum(p_qty) FROM g_stock";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    public function checkIfProductExistGStock(GStock $gstock){
        $p_id = $gstock->getPId();
        $query = "SELECT * FROM g_stock WHERE p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function selectProductQty(GStock $gstock){
        $p_id = $gstock->getPId();
        $query = "SELECT p_qty FROM g_stock  WHERE g_stock.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->fetch();
            return $result;    
    }






    public function updateProductQty(GStock $gstock){
        $p_qty = $gstock->getPQty();
        $p_pprice = $gstock->getPPrice();
        $p_id = $gstock->getPId();
        
        $query = "UPDATE g_stock SET p_qty = ?,p_pprice = ? WHERE g_stock.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_qty,
            $p_pprice,
            $p_id
          
        ));
        return $result;
    }

    public function selectGStock(){
        $query = "SELECT sessions.*,products.*,g_stock.* FROM g_stock JOIN sessions ON 
        sessions.s_id = g_stock.s_id JOIN products ON products.p_id = g_stock.p_id";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    public function selectGStockById(GStock $gstock){
        $p_id = $gstock->getPId();
        $query = "SELECT sessions.*,products.*,g_stock.* FROM g_stock JOIN sessions ON 
        sessions.s_id = g_stock.s_id JOIN products ON products.p_id = g_stock.p_id WHERE g_stock.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_id
        ));
        $result = $statement->fetch();
        return $result;
        
    }


    public function selectGStockByFilter($productByFilter){
        $query = "SELECT sessions.*,products.*,g_stock.* FROM g_stock JOIN sessions ON 
        sessions.s_id = g_stock.s_id JOIN products ON products.p_id = g_stock.p_id  $productByFilter ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }











}





?>