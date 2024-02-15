<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/OrderDetails.php');


class OrderDetailsDao extends db{
    public function createOrderDetails(OrderDetails $details){
        $s_id = $details->getSId();
        $o_id = $details->getOId();
        $e_id = $details->getEId();
        $p_id = $details->getPId();
        $pt_id = $details->getPtId();
        $p_qty = $details->getPQty();
        $unity_id = $details->getUnityId();
        $p_price = $details->getPPrice();
        $s_price = $details->getSPrice();

        $query = "INSERT INTO order_details(s_id,o_id,e_id,p_id,pt_id,p_qty,unity_id,p_price,s_price) VALUE(?,?,?,?,?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_id,
            $o_id,
            $e_id,
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
        $o_id = $details->getOId();
        $query = "SELECT product_type.*,sessions.*,orders.*,products.*,unity.*,order_details.* FROM order_details JOIN orders on 
        orders.o_id = order_details.o_id JOIN product_type ON product_type.pt_id = order_details.pt_id  JOIN products
        ON products.p_id = order_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = order_details.unity_id  WHERE order_details.o_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    public function selectOrderDetailsByOIdAndByFood(OrderDetails $details){
        $o_id = $details->getOId();
        $query = "SELECT product_type.*,sessions.*,orders.*,products.*,unity.*,order_details.* FROM order_details JOIN orders on 
        orders.o_id = order_details.o_id JOIN product_type ON product_type.pt_id = order_details.pt_id  JOIN products
        ON products.p_id = order_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = order_details.unity_id  WHERE order_details.o_id = ? AND order_details.pt_id = 2";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }



    public function selectOrderDetailsOneP(OrderDetails $details){
        $od_id = $details->getOdId();
        $query = "SELECT product_type.*,sessions.*,orders.*,products.*,unity.*,order_details.* FROM order_details JOIN orders on 
        orders.o_id = order_details.o_id JOIN product_type ON product_type.pt_id = order_details.pt_id  JOIN products
        ON products.p_id = order_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = order_details.unity_id  WHERE order_details.od_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $od_id
        ));
        $result = $statement->fetch();
        return $result; 
    }


    

    public function checkProductOnOrderDetailsExists(OrderDetails $details){
        $o_id = $details->getOId();
        $p_id = $details->getPId();
        $unity_id = $details->getUnityId();
        $query = "SELECT * FROM order_details WHERE order_details.o_id = ? AND order_details.p_id = ? AND order_details.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id,
            $p_id,
            $unity_id
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function updateQtyOnOrderDetails(OrderDetails $details){
        $p_qty = $details->getPQty();
        $o_id = $details->getOId();
        $p_id = $details->getPId();
        $unity_id = $details->getUnityId();

        $query = "UPDATE  order_details SET order_details.p_qty = ?  WHERE order_details.o_id = ? AND order_details.p_id = ? AND order_details.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_qty,
            $o_id,
            $p_id,
            $unity_id
        ));
         
        return $result;
    }



    public function updateQtyOnVoidOrderDetails(OrderDetails $details){
        $p_qty = $details->getPQty();
        $od_id = $details->getOdId();
        $query = "UPDATE  order_details SET order_details.p_qty = ?  WHERE order_details.od_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_qty,
            $od_id
        ));
         
        return $result;
    }


    public function deleteOrderDetails(OrderDetails $details){
        $od_id = $details->getOdId();
        $query = "DELETE FROM  order_details  WHERE order_details.od_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $od_id
        ));
         
        return $result;
    }

    public function selectProductQtyOrderDetails(OrderDetails $details){
        $o_id = $details->getOId();
        $p_id = $details->getPId();
        $unity_id = $details->getUnityId();

        $query = "SELECT p_qty FROM order_details  WHERE order_details.o_id = ? AND order_details.p_id = ? AND order_details.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id,
            $p_id,
            $unity_id
        ));
        $result = $statement->fetch();
            return $result;    
    }


    public function selectProductUnityBySid(OrderDetails $details){
        $s_id = $details->getSId();
        $query = "SELECT DISTINCT unity_id,p_id
        FROM order_details
        WHERE order_details.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id,
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }


    public function selectOrderForIndividual(OrderDetails $details){
        $e_id = $details->getEId();
        $query = "SELECT DISTINCT p_id,unity_id
        FROM order_details
        WHERE order_details.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }

    public function selectUnityByE_id(OrderDetails $details){
        $s_id = $details->getSId();
        $e_id = $details->getEId();
        $query = "SELECT DISTINCT unity_id, s_id,e_id,p_id 
        FROM order_details
        WHERE order_details.s_id = ? AND order_details.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id,
            $e_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }

    public function selectUnityByAll(OrderDetails $details){
        $s_id = $details->getSId();
        $query = "SELECT DISTINCT unity_id,s_id,p_id 
        FROM order_details
        WHERE order_details.s_id = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }



    public function selectQtyOfProductByUnityBySid(OrderDetails $details){
        $s_id = $details->getSId();
        $p_id = $details->getPId();
        $unity_id = $details->getUnityId();
        $query = "SELECT  p_id,unity_id,p_price,s_price,SUM(p_qty) AS total_quantity
        FROM order_details
        WHERE order_details.s_id = ? AND order_details.p_id = ? AND order_details.unity_id = ?
        ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id,
            $p_id,
            $unity_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }


    public function selectSalesForIndividual(OrderDetails $details){
        $e_id = $details->getEId();
        $s_id = $details->getSId();
        $p_id = $details->getPId();
        $unity_id = $details->getUnityId();
        $query = "SELECT DISTINCT   order_details.unity_id,order_details.p_id,order_details.s_price,SUM(p_qty) AS total_quantity,product_type.*,sessions.*,orders.*,products.*,unity.* 
        FROM order_details JOIN orders on 
        orders.o_id = order_details.o_id JOIN product_type ON product_type.pt_id = order_details.pt_id  JOIN products
        ON products.p_id = order_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = order_details.unity_id 
        WHERE order_details.e_id = ? AND order_details.s_id = ? AND order_details.p_id = ? AND order_details.unity_id = ?
        ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id,
            $p_id,
            $unity_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }


    public function selectSalesForAll(OrderDetails $details){
        $s_id = $details->getSId();
        $unity_id = $details->getUnityId();
        $p_id = $details->getPId();

        $query = "SELECT DISTINCT   order_details.unity_id,order_details.p_id,order_details.s_price,SUM(p_qty) AS total_quantity,product_type.*,sessions.*,orders.*,products.*,unity.* 
        FROM order_details JOIN orders on 
        orders.o_id = order_details.o_id JOIN product_type ON product_type.pt_id = order_details.pt_id  JOIN products
        ON products.p_id = order_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = order_details.unity_id 
        WHERE  order_details.s_id = ?  AND order_details.unity_id = ? AND order_details.p_id = ?
        ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id,
            $unity_id,
            $p_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }





}






?>