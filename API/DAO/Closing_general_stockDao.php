<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Closing_general_stock.php');

class Closing_general_stockDao extends db{
    public function createCGStock(Closing_general_stock $cgStock){
        $s_ref = $cgStock->getSRef();
        $p_id = $cgStock->getPId();
        $p_qty = $cgStock->getPQty();
        $p_pprice = $cgStock->getPPrice();
        $query = "INSERT INTO closing_general_stock(s_ref,p_id,p_qty,p_pprice) VALUES(?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_ref,
            $p_id, 
            $p_qty,
            $p_pprice
        ));
        return $result;
    }


    public function selectGStockBySid(Closing_general_stock $cgStock) {
        $s_ref = $cgStock->getSRef();
        $query = "SELECT products.*,sessions.*,closing_general_stock.* FROM closing_general_stock JOIN products ON products.p_id = closing_general_stock.p_id JOIN sessions ON sessions.s_ref = closing_general_stock.s_ref WHERE closing_general_stock.s_ref = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_ref
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }









}




?>