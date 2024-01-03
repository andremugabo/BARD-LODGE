<?php
require_once"db.php";
require_once"../MODEL/Users.php";


class UsersDao extends db{

    public function createUser(Users $users) {
        $u_name = $users->getUName();
        $u_password = $users->getUPassword();

        $query = "INSERT INTO users (u_name,u_password) VALUES (?,?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $u_name,
            $u_password            
        ));
        return $result;
    }

    public function checkIfUserExist(Users $users)
    {
        $username = $users->getUName();
        $password = $users->getUPassword();
        $query = "SELECT  *  FROM users WHERE users.u_name = ? and users.u_password = ? and users.u_status = 1";
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



}






?>