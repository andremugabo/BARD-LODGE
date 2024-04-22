<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/Special.php');


class SpecialDao extends db{

    public function checkSpecialExists(Special $special){
        $o_ref = $special->getORef();
        $query = "SELECT * FROM special WHERE special.o_ref = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_ref
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function selectSpecialById(Special $special){
        $o_ref = $special->getORef();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.o_ref = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_ref
        ));
        $result = $statement->fetch();
        return $result;
    }


    public function selectSpecialByIdAndPaid(special $special){
        $o_ref = $special->getORef();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.o_ref = ? AND special.o_payment = 'PAID'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_ref
        ));
        $result = $statement->fetch();
        return $result;
    }

    public function countSpecial(){
        $query = "SELECT * FROM special ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->rowCount();
        return $result;
    }

    


    public function countSpecialBySId(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT * FROM special  WHERE special.s_id = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function countSpecialBySIdUnPaid(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT * FROM special  WHERE special.s_id = ? AND special.o_payment = 'NOT PAID'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function countSpecialBySIdPaid(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT * FROM special  WHERE special.s_id = ? AND special.o_payment = 'PAID'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function countSpecialBySIdCredit(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT * FROM special  WHERE special.s_id = ? AND special.payment_mode = 'DEBT'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function createSpecials(Special $special){
        $o_ref = $special->getORef();
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "INSERT INTO special(o_ref,e_id,s_id) VALUE(?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $o_ref,
            $e_id,
            $s_id
        ));
        return $result;
    }

    public function createSpecialSpecials(Special $special){
        $o_ref = $special->getORef();
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $o_table = $special->getOTable();
        $query = "INSERT INTO special(o_ref,e_id,s_id,o_table) VALUE(?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $o_ref,
            $e_id,
            $s_id,
            $o_table
        ));
        return $result;
    }


    public function updatePaySpecials(Special $special){
       
        $o_amount = $special->getOAmount();
        $payment_mode = $special->getPaymentMode();
        $c_name = $special->getCName();
        $c_phone = $special->getCPhone();
        $o_id = $special->getOId();


        $query = "UPDATE special  SET o_amount = ?, o_payment = 'PAID',payment_mode = ? ,c_name = ? , c_phone = ? WHERE special.o_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $o_amount,
            $payment_mode,
            $c_name,
            $c_phone,
            $o_id
        ));
        return $result;
    }


    public function selectSpecialsByEIdAndSId(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ? AND special.o_payment = 'NOT PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectSpecialsByEIdAndSIdAllSpecial(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectSpecialSpecial(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ? AND special.o_table = '1'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectPaymentMode(Special $special,$paymentMode){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ?  $paymentMode";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id,

        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }


    public function selectPaymentModeAll(Special $special,$paymentMode){
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE  special.s_id = ?  $paymentMode";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectEmployee(Special $special,$byPaymentMode){
        $s_id = $special->getSId();
        $query = "SELECT DISTINCT special.e_id,employees.*,sessions.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE  special.s_id = ? $byPaymentMode";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectSpecialsSIdAndEIdSales(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT DISTINCT special.e_id, employees.*,sessions.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function countSpecialsByEIdAndSIdUnPaid(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ? AND special.o_payment = 'NOT PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }

    public function countSpecialsByEIdAndSIdPaid(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ? AND special.o_payment = 'PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }


    public function countSpecialsByEIdAndSIdSpecial(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }

    public function countSpecialsByEIdAndSIdCredits(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ? AND special.o_payment='DEBT'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }

    public function countSpecialsByEIdAllSpecial(Special $special){
        $e_id = $special->getEId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id
           
        ));

        $result = $statement->rowCount();
            return $result;

    }

    

    public function selectSpecialsByEIdAndSIdAndPaid(Special $special){
        $e_id = $special->getEId();
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE special.e_id = ? AND special.s_id = ? AND special.o_payment = 'PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectSpecialBySId(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE  special.s_id = ? AND special.o_payment = 'NOT PAID' ";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }



    public function selectSpecialsBySIdForReport(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE  special.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }


    public function selectSpecialsBySIdForReportDebt(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE  special.s_id = ? AND special.payment_mode = 'DEBT'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }




    public function selectSpecialByEidAndDebt(Special $special){
        $e_id = $special->getEId();
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE  special.e_id = ? AND special.payment_mode = 'DEBT'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }


    public function selectSpecialDebt(){
        $query = "SELECT employees.*,sessions.*,special.* FROM special JOIN employees 
        ON employees.e_id = special.e_id JOIN sessions 
        ON sessions.s_id = special.s_id  WHERE  special.payment_mode = 'DEBT'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function updatePaymentMode(Special $special){
        // $payment_mode = $special->getPaymentMode();
        $o_ref = $special->getORef();
        $query = "UPDATE special  SET payment_mode ='CASH'  WHERE special.o_ref = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
        //    $payment_mode,
           $o_ref 
        ));
        return $result;
    }

    public function checkNotPaidspecialBySid(Special $special){
        $s_id = $special->getSId();
        $query = "SELECT * FROM special  WHERE  special.s_id = ? AND o_payment = 'NOT PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        $result = $statement->rowCount();
        return $result;
      

    }

}



?>