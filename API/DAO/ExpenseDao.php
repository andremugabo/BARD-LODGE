<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Expense.php');

class ExpenseDao extends db{

    public function createExpense(Expense $expense){
        $s_id = $expense->getSId();
        $exp_category = $expense->getExpCategory();
        $exp_description = $expense->getExpDescription();
        $exp_amount = $expense->getExpAmount();

        $query = "INSERT INTO expenses (s_id,exp_category,exp_description,exp_amount) VALUES(?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_id,
            $exp_category,
            $exp_description,
            $exp_amount
        ));
        return $result;
    }

    public function selectExpenseBySId(Expense $ExpenseObj){
        $s_id = $ExpenseObj->getSId();
        $query = "SELECT * FROM expenses WHERE s_id = ? ";
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