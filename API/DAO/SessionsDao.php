<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/Sessions.php');



class SessionsDao extends db{
    public function createSession(Sessions $session){
        $s_ref = $session->getSRef();
        $query = "INSERT INTO sessions(s_ref) VALUES(?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_ref
        ));
        return $result;
    }

    public function checkOpenSessions(){
        $query = "SELECT * FROM sessions WHERE s_status = 'OPEN'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->rowCount();
        return $result;
    }


    public function closeSession(Sessions $session){
        $s_id = $session->getSId();
        $query = "UPDATE sessions SET s_status = 'CLOSE' WHERE sessions.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_id
        ));
        return $result;
    }

    public function selectCurrentOpenSession(){
        $query = "SELECT s_id FROM sessions WHERE sessions.s_status = 'OPEN'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
            return $result;    
    }

    public function selectOpenSession(){
        $query = "SELECT * FROM sessions  WHERE sessions.s_status = 'OPEN'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }

    public function selectSessionBySid(Sessions $session){
        $s_id = $session->getSId();
        $query = "SELECT * FROM sessions WHERE sessions.s_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));
       $result = $statement->fetch();
            return $result;
    }

    public function selectAllSession(){
        $query = "SELECT * FROM sessions ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }
    
    public function selectClosedSession(){
        $query = "SELECT * FROM sessions  WHERE sessions.s_status = 'CLOSE'";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
    }

    public function countSessions(){
        $query = "SELECT * FROM sessions";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->rowCount();
        return $result;
    }


}







?>