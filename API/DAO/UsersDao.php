<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Users.php');


class UsersDao extends db{

    public function createUser(Users $users) {
        $e_id = $users->getEId();
        $u_name = $users->getUName();
        $u_password = $users->getUPassword();

        $query = "INSERT INTO users (e_id,u_name,u_password) VALUES (?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $e_id,
            $u_name,
            $u_password            
        ));
        return $result;
    }

    public function checkIfUserExist(Users $users)
    {
        $username = $users->getUName();
        $password = $users->getUPassword();
        $query = "SELECT  *  FROM users WHERE users.u_name = ? and users.u_password = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $username,
            $password
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function getUserId(Users $users)
    {
        $username = $users->getUName();
        $password = $users->getUPassword();
        $query = "SELECT  e_id  FROM users WHERE users.u_name = ? and users.u_password = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $username,
            $password
        ));
        $result = $statement->fetch();
        return $result;
    }


    public function checkIfUserExistById(Users $users)
    {
        $e_id = $users->getEId();
        $query = "SELECT  *  FROM users WHERE users.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }


    public function selectUsers() {
        $query = "SELECT employees.*,users.* FROM users JOIN employees ON users.e_id = employees.e_id   WHERE users.u_status = 1 AND employees.e_role <> 'IT' AND employees.e_role <> 'MD'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }

    public function disableUser(Users $users)
    {
        $e_id = $users->getEId();
        $query = "UPDATE users SET users.u_status = '0' WHERE users.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $e_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function updateUserName(Users $users)
    {
        $u_name = $users->getUName();
        $e_id = $users->getEId();
        $query = "UPDATE users SET users.u_name = ? WHERE users.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $result =  $statement->execute(array(
            $u_name,
            $e_id
        ));
        return $result;
    }

    public function updatePassword(Users $users)
    {
        $u_password = $users->getUPassword();
        $e_id = $users->getEId();
        $query = "UPDATE users SET users.u_password = ? WHERE users.e_id = ?";
        $statement = $this->connect()->prepare($query);
        $result =  $statement->execute(array(
            $u_password,
            $e_id
        ));
        return $result;
    }



}






?>