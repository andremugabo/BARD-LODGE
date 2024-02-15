<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/Orders.php');


class OrdersDao extends db{

    public function checkOrderExists(Orders $Order){
        $o_ref = $Order->getORef();
        $query = "SELECT * FROM orders WHERE orders.o_ref = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_ref
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function selectOrderById(Orders $Order){
        $o_ref = $Order->getORef();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.o_ref = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_ref
        ));
        $result = $statement->fetch();
        return $result;
    }


    public function selectOrderByIdAndPaid(Orders $Order){
        $o_ref = $Order->getORef();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.o_ref = ? AND orders.o_payment = 'PAID'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $o_ref
        ));
        $result = $statement->fetch();
        return $result;
    }

    public function countOrder(){
        $query = "SELECT * FROM orders ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->rowCount();
        return $result;
    }

    


    public function countOrderBySId(Orders $order){
        $s_id = $order->getSId();
        $query = "SELECT * FROM orders  WHERE orders.s_id = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function countOrderBySIdUnPaid(Orders $order){
        $s_id = $order->getSId();
        $query = "SELECT * FROM orders  WHERE orders.s_id = ? AND orders.o_payment = 'NOT PAID'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function countOrderBySIdPaid(Orders $order){
        $s_id = $order->getSId();
        $query = "SELECT * FROM orders  WHERE orders.s_id = ? AND orders.o_payment = 'PAID'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function countOrderBySIdCredit(Orders $order){
        $s_id = $order->getSId();
        $query = "SELECT * FROM orders  WHERE orders.s_id = ? AND orders.payment_mode = 'DEBT'";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function createOrders(Orders $order){
        $o_ref = $order->getORef();
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "INSERT INTO orders(o_ref,e_id,s_id) VALUE(?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $o_ref,
            $e_id,
            $s_id
        ));
        return $result;
    }


    public function updatePayOrders(Orders $order){
       
        $o_amount = $order->getOAmount();
        $payment_mode = $order->getPaymentMode();
        $c_name = $order->getCName();
        $c_phone = $order->getCPhone();
        $o_id = $order->getOId();


        $query = "UPDATE orders  SET o_amount = ?, o_payment = 'PAID',payment_mode = ? ,c_name = ? , c_phone = ? WHERE orders.o_id = ?";
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


    public function selectOrdersByEIdAndSId(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ? AND orders.o_payment = 'NOT PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectOrdersByEIdAndSIdAllOrder(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }


    public function selectPaymentMode(Orders $order,$paymentMode){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ?  $paymentMode";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id,

        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }


    public function selectPaymentModeAll(Orders $order,$paymentMode){
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE  orders.s_id = ?  $paymentMode";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectEmployee(Orders $order,$byPaymentMode){
        $s_id = $order->getSId();
        $query = "SELECT DISTINCT orders.e_id,employees.*,sessions.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE  orders.s_id = ? $byPaymentMode";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectOrdersSIdAndEIdSales(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT DISTINCT orders.e_id, employees.*,sessions.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function countOrdersByEIdAndSIdUnPaid(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ? AND orders.o_payment = 'NOT PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }

    public function countOrdersByEIdAndSIdPaid(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ? AND orders.o_payment = 'PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }


    public function countOrdersByEIdAndSIdOrder(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }

    public function countOrdersByEIdAndSIdCredits(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ? AND orders.o_payment='DEBT'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        $result = $statement->rowCount();
            return $result;

    }

    public function countOrdersByEIdAllOrder(Orders $order){
        $e_id = $order->getEId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id
           
        ));

        $result = $statement->rowCount();
            return $result;

    }

    

    public function selectOrdersByEIdAndSIdAndPaid(Orders $order){
        $e_id = $order->getEId();
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE orders.e_id = ? AND orders.s_id = ? AND orders.o_payment = 'PAID'";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }

    public function selectOrdersBySId(Orders $order){
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE  orders.s_id = ? AND orders.o_payment = 'NOT PAID' ";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }



    public function selectOrdersBySIdForReport(Orders $order){
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE  orders.s_id = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }


    public function selectOrdersBySIdForReportDebt(Orders $order){
        $s_id = $order->getSId();
        $query = "SELECT employees.*,sessions.*,orders.* FROM orders JOIN employees 
        ON employees.e_id = orders.e_id JOIN sessions 
        ON sessions.s_id = orders.s_id  WHERE  orders.s_id = ? AND orders.payment_mode = 'DEBT'";

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