<?php 
require_once 'db.php';
require_once(__DIR__.'/../MODEL/Special_details.php');

class SpecialDetailsDao extends db{
    public function createSpecialDetails(SpecialDetails $special){
        $s_id = $special->getSId();
        $o_id = $special->getOId();
        $e_id = $special->getEId();
        $p_id = $special->getPId();
        $pt_id = $special->getPtId();
        $p_qty = $special->getPQty();
        $unity_id = $special->getUnityId();
        $p_price = $special->getPPrice();
        $s_price = $special->getSPrice();

        $query = "INSERT INTO special_details(s_id,o_id,e_id,p_id,pt_id,p_qty,unity_id,p_price,s_price) VALUE(?,?,?,?,?,?,?,?,?)";
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



    public function selectSpecialDetailsByOId(SpecialDetails $special){
        $o_id = $special->getOId();
        $query = "SELECT product_type.*,sessions.*,orders.*,products.*,unity.*,special_details.* FROM special_details JOIN orders on 
        orders.o_id = special_details.o_id JOIN product_type ON product_type.pt_id = special_details.pt_id  JOIN products
        ON products.p_id = special_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = special_details.unity_id  WHERE special_details.o_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }

    public function selectSpecialDetailsByOIdAndByFood(SpecialDetails $special){
        $o_id = $special->getOId();
        $query = "SELECT product_type.*,sessions.*,orders.*,products.*,unity.*,special_details.* FROM special_details JOIN orders on 
        orders.o_id = special_details.o_id JOIN product_type ON product_type.pt_id = special_details.pt_id  JOIN products
        ON products.p_id = special_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = special_details.unity_id  WHERE special_details.o_id = ? AND special_details.pt_id = 2";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }

    public function selectSpecialDetailsOneP(SpecialDetails $special){
        $od_id = $special->getOdId();
        $query = "SELECT product_type.*,sessions.*,orders.*,products.*,unity.*,special_details.* FROM special_details JOIN orders on 
        orders.o_id = special_details.o_id JOIN product_type ON product_type.pt_id = special_details.pt_id  JOIN products
        ON products.p_id = special_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = special_details.unity_id  WHERE special_details.od_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $od_id
        ));
        $result = $statement->fetch();
        return $result; 
    }


    public function checkProductOnSpecialDetailsExists(SpecialDetails $special){
        $o_id = $special->getOId();
        $p_id = $special->getPId();
        $unity_id = $special->getUnityId();
        $query = "SELECT * FROM special_details WHERE special_details.o_id = ? AND special_details.p_id = ? AND special_details.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id,
            $p_id,
            $unity_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function updateQtyOnSpecialDetails(SpecialDetails $special){
        $p_qty = $special->getPQty();
        $o_id = $special->getOId();
        $p_id = $special->getPId();
        $unity_id = $special->getUnityId();

        $query = "UPDATE  special_details SET special_details.p_qty = ?  WHERE special_details.o_id = ? AND special_details.p_id = ? AND special_details.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_qty,
            $o_id,
            $p_id,
            $unity_id
        ));
         
        return $result;
    }


    public function updateQtyOnVoidSpecialDetails(SpecialDetails $special){
        $p_qty = $special->getPQty();
        $od_id = $special->getOdId();
        $query = "UPDATE  special_details SET special_details.p_qty = ?  WHERE special_details.od_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $p_qty,
            $od_id
        ));
         
        return $result;
    }


    public function deleteSpecialDetails(SpecialDetails $special){
        $od_id = $special->getOdId();
        $query = "DELETE FROM  special_details  WHERE special_details.od_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $od_id
        ));
         
        return $result;
    }

    public function selectProductQtySpecialDetails(SpecialDetails $special){
        $o_id = $special->getOId();
        $p_id = $special->getPId();
        $unity_id = $special->getUnityId();

        $query = "SELECT p_qty FROM special_details  WHERE special_details.o_id = ? AND special_details.p_id = ? AND special_details.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_id,
            $p_id,
            $unity_id
        ));
        $result = $statement->fetch();
            return $result;    
    }


    public function selectProductUnityBySid(SpecialDetails $special){
        $s_id = $special->getSId();
        $query = "SELECT DISTINCT unity_id,p_id
        FROM special_details
        WHERE special_details.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id,
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }

    public function selectOrderForIndividual(SpecialDetails $special){
        $e_id = $special->getEId();
        $query = "SELECT DISTINCT p_id,unity_id
        FROM special_details
        WHERE special_details.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }

    public function selectUnityByE_id(SpecialDetails $special){
        $s_id = $special->getSId();
        $e_id = $special->getEId();
        $query = "SELECT DISTINCT unity_id, s_id,e_id,p_id 
        FROM special_details
        WHERE special_details.s_id = ? AND special_details.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id,
            $e_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }

    public function selectUnityByAll(SpecialDetails $special){
        $s_id = $special->getSId();
        $query = "SELECT DISTINCT unity_id,s_id,p_id 
        FROM special_details
        WHERE special_details.s_id = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }  
    }



    public function selectQtyOfProductByUnityBySid(SpecialDetails $special){
        $s_id = $special->getSId();
        $p_id = $special->getPId();
        $unity_id = $special->getUnityId();
        $query = "SELECT  p_id,unity_id,p_price,s_price,SUM(p_qty) AS total_quantity
        FROM special_details
        WHERE special_details.s_id = ? AND special_details.p_id = ? AND special_details.unity_id = ?
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


    public function selectSalesForIndividual(SpecialDetails $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $p_id = $special->getPId();
        $unity_id = $special->getUnityId();
        $query = "SELECT DISTINCT   special_details.unity_id,special_details.p_id,special_details.s_price,SUM(p_qty) AS total_quantity,product_type.*,sessions.*,orders.*,products.*,unity.* 
        FROM special_details JOIN orders on 
        orders.o_id = special_details.o_id JOIN product_type ON product_type.pt_id = special_details.pt_id  JOIN products
        ON products.p_id = special_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = special_details.unity_id 
        WHERE special_details.e_id = ? AND special_details.s_id = ? AND special_details.p_id = ? AND special_details.unity_id = ? AND orders.o_table <> '1'
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


    public function selectSalesForAll(SpecialDetails $special){
        $s_id = $special->getSId();
        $unity_id = $special->getUnityId();
        $p_id = $special->getPId();

        $query = "SELECT DISTINCT   special_details.unity_id,special_details.p_id,special_details.s_price,SUM(p_qty) AS total_quantity,product_type.*,sessions.*,orders.*,products.*,unity.* 
        FROM special_details JOIN orders on 
        orders.o_id = special_details.o_id JOIN product_type ON product_type.pt_id = special_details.pt_id  JOIN products
        ON products.p_id = special_details.p_id JOIN sessions ON sessions.s_id = orders.s_id  JOIN unity 
        ON unity.unity_id = special_details.unity_id 
        WHERE  special_details.s_id = ?  AND special_details.unity_id = ? AND special_details.p_id = ? AND orders.o_table <> '1'
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