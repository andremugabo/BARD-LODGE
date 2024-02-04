<?php
require_once 'db.php';
require_once (__DIR__.'/../MODEL/Voided_order.php');

class Voided_orderDao extends db{
    public function createVoidOrder(Voided_order $void) {
        $o_id = $void->getOId();
        $e_id = $void->getEId();
        $p_id = $void->getPId();
        $p_qty = $void->getPQty();
        $unity_id = $void->getUnityId();
        $v_reason = $void->getVReason();

        $query = "INSERT INTO voided_order(o_id,e_id,p_id,o_qty,unity_id,v_reason) VALUES (?,?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $o_id,
            $e_id,
            $p_id, 
            $p_qty,
            $unity_id,
            $v_reason        
        ));
        return $result;
    }


    public function checkProductExist(Voided_order $void)
    {
        $o_id = $void->getOId();
        $p_id = $void->getPId();
        $unity_id = $void->getUnityId();    
        $query = "SELECT  *  FROM voided_order WHERE o_id = ? AND p_id = ? AND unity_id =?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id,
            $p_id,
            $unity_id 
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function selectVoidOrder() {
        $query = "SELECT * FROM  voided_order";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }

    public function selectPerOrder(Voided_order $void){
        $o_id = $void->getOId();
		$sql = "SELECT * FROM voided_order WHERE voided_order.o_id = ? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
            $o_id 
		));

		while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
		
	}

    public function updateQty(Voided_order $void)
    {
        $p_qty = $void->getPQty();
        $o_id = $void->getOId();
        $p_id = $void->getPId();
        $unity_id = $void->getUnityId();  
        $query = "UPDATE voided_order SET o_qty = ? WHERE o_id = ?  AND p_id = ? AND unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $p_qty,
            $o_id,
            $p_id,
            $unity_id
        ));
        $result = $statement->execute();
        return $result;
    }













}




?>