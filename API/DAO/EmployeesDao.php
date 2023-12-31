<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Employees.php');

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

    public function getEmployeeById(Employees $employee) {
        $e_id = $employee->getEId();
        $query = "SELECT * FROM employees WHERE employees.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id            
        ));
        $result =  $statement->fetch();
        return $result;
    }

    public function checkIfEmployeeExist(Employees $employee) {
        $e_phone = $employee->getEPhone();
        $query = "SELECT * FROM employees WHERE employees.e_phone = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_phone            
        ));
        $result =  $statement->rowCount();
        return $result;
    }

    public function selectEmployee() {
        $query = "SELECT * FROM employees";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }

    public function countEmployee(){
        $query = "SELECT * FROM employees";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result =  $statement->rowCount();
        return $result;
    }


    public function updateEmployee(Employees $employee) {
        $firstname = $employee->getFirstname();
        $lastname = $employee->getLastname();
        $role = $employee->getERole();
        $phone = $employee->getEPhone();
        $idNumber = $employee->getEIdNumber();
        $e_id = $employee->getEId();
        

        $query = "UPDATE employees SET  firstname = ?, lastname = ?, e_role = ?, e_phone = ?, e_idNumber = ? WHERE employees.E_ID = ?";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $firstname,
            $lastname,
            $role,
            $phone,
            $idNumber,
            $e_id
        ));
        return $result;
    }






    
}





?>