<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Employees.php');

class EmployeesDao extends db
{

    public function createEmployee(Employees $employee) {

        // Extract employee data using getters
        $regNumber = $employee->getERegNumber();
        $firstname = $employee->getFirstname();
        $lastname = $employee->getLastname();
        $role = $employee->getERole();
        $phone = $employee->getEPhone();
        $idNumber = $employee->getEIdNumber();
    
        // Prepare the query with named placeholders
        $query = "INSERT INTO employees (e_regNumber, firstname, lastname, e_role, e_phone, e_idNumber) 
                  VALUES (:regNumber, :firstname, :lastname, :role, :phone, :idNumber)";
    
        // Bind values to named placeholders for security and clarity
        $statement = $this->connect()->prepare($query);
        $statement->bindValue(':regNumber', $regNumber);
        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':role', $role);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':idNumber', $idNumber);
    
        // Execute the query and return the result
        $result = $statement->execute();
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
        $query = "SELECT * FROM employees WHERE employees.e_status = '1' AND employees.e_role <> 'IT' AND employees.e_role <> 'MD'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }

    public function countEmployee(){
        $query = "SELECT * FROM employees ";
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