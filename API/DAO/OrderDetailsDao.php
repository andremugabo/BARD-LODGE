<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/OrderDetails.php');


class OrderDetailsDao extends db{
    public function createOrderDetails(OrderDetails $details){
        $s_id = $details->getSId();
        $o_id = $details->getOId();
        $p_id = $details->getPId();
        $pt_id = $details->getPtId();
        $p_qty = $details->getPQty();
        $unity_id = $details->getUnityId();
        $p_price = $details->getPPrice();
        $s_price = $details->getSPrice();

        $query = "INSERT INTO order_details(s_id,o_id,p_id,pt_id,p_qty,unity_id,p_price,s_price) VALUE(?,?,?,?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_id,
            $o_id,
            $p_id,
            $pt_id,
            $p_qty,
            $unity_id,
            $p_price,
            $s_price 
        ));
        return $result;
    }


    public function selectOrderDetailsByOId(OrderDetails $details){
        $o_id = $details->getOdId();
        $query = "SELECT product_type.*,sessions.*,orders.*,products.*,unity.* FROM order_details JOIN orders on 
        orders.o_id = order_details.o_id JOIN product_type ON product_type.pt_id = order_details.pt_id  JOIN products
        ON products.p_id = order_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = order_details.unity  WHERE orders.o_ref = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    public function checkProductOnOrderDetailsExists(OrderDetails $details){
        $o_id = $details->getOId();
        $p_id = $details->getPId();
        $query = "SELECT * FROM order_details WHERE order_details.o_id = ? AND order_details.p_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id,
            $p_id
        ));
        $result = $statement->rowCount();
        return $result;
    }






}






?>