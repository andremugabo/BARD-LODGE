<?php
require_once"db.php";
require_once"../MODEL/Employees.php";
class EmployeesDao extends db
{

    public function createEmployee(Employees $employee) {
        $regNumber = $employee->getERegNumber();
        $firstname = $employee->getFirstname();
        $lastname = $employee->getLastname();
        $role = $employee->getERole();
        $phone = $employee->getEPhone();
        $idNumber = $employee->getEIdNumber();
        

        $query = "INSERT INTO employees (e_regNumber, firstname, lastname, e_role, e_phone, e_idNumber) VALUES (?,?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $regNumber,
            $firstname,
            $lastname,
            $role,
            $phone,
            $idNumber
        ));
        return $result;
    }









    
}





?>