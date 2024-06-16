<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/Oincome.php');

class OincomeDao extends db{

    public function checkOIncomeExists(Oincome $oincome){
        $oi_category = $oincome->getOiCategory();
        $oi_name = $oincome->getOiName();
        $query = "SELECT * FROM o_income WHERE o_income.oi_category = ? AND o_income.oi_name = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $oi_category,
            $oi_name,
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function createOincame(Oincome $oincome){ 
        $oi_category = $oincome->getOiCategory();
        $oi_name = $oincome->getOiName();
        $oi_price = $oincome->getOiPrice();
       
        $query = "INSERT INTO o_income(oi_category,oi_name,oi_price) VALUE(?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $oi_category,
            $oi_name,
            $oi_price
        ));
        return $result;
    }

    public function selectOIncome(){
        $query = "SELECT * FROM o_income WHERE o_income.oi_status = '1'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->rowCount();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


    public function selectOIncomeById(Oincome $oincome){
        $oi_id = $oincome->getOiId();
        $query = "SELECT * FROM o_income WHERE o_income.oi_id = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $oi_id
        ));
        $result = $statement->fetch();
        return $result;
    }


    public function editOincame(Oincome $oincome){ 
        $oi_category = $oincome->getOiCategory();
        $oi_name = $oincome->getOiName();
        $oi_price = $oincome->getOiPrice();
        $oi_id = $oincome->getOiId();

        $query = "UPDATE  o_income SET oi_category = ? , oi_name = ?, oi_price = ? WHERE  o_income.oi_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $oi_category,
            $oi_name,
            $oi_price,
            $oi_id
        ));
        return $result;
    }

    public function selectOIncomeByCategory(){
        $query = "SELECT * FROM o_income WHERE o_income.oi_category = 'BILLIARD' ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }


}
























?>