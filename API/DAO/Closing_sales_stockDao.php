<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Closing_sales_stock.php');

class Closing_sales_stockDao extends db{
    public function createCSStock(Closing_sales_stock $csStock){
        $s_ref = $csStock->getSRef();
        $p_id = $csStock->getPId();
        $p_qty = $csStock->getPQty();
        $p_pprice = $csStock->getPPrice();
        $query = "INSERT INTO closing_sales_stock(s_ref,p_id,p_qty,p_pprice) VALUES(?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_ref,
            $p_id, 
            $p_qty,
            $p_pprice
        ));
        return $result;
    }


    public function selectSStockBySid(Closing_sales_stock $csStock) {
        $s_ref = $csStock->getSRef();
        $query = "SELECT products.*,sessions.*,closing_sales_stock.* FROM closing_sales_stock JOIN products ON products.p_id = closing_sales_stock.p_id JOIN sessions ON sessions.s_ref = closing_sales_stock.s_ref WHERE closing_sales_stock.s_ref = ?";
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