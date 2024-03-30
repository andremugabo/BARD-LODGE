<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/IncomeDetails.php');

class IncomeDetailsDao extends db{

    public function createIncome(IncomeDetails $inObj){
        $s_id = $inObj->getSId();
        $ind_name = $inObj->getIndName();
        $ind_details = $inObj->getIndDetails();
        $ind_amount = $inObj->getIndAmount();        
        $query = "INSERT INTO incomeDetails(s_id,ind_name,ind_details,ind_amount) VALUE(?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
           $s_id,
           $ind_name,
           $ind_details,
           $ind_amount 
        ));
        return $result;
    }





}








?>