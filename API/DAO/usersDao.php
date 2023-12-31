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




}






?>