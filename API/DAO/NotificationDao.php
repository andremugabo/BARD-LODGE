<?php
require_once 'db.php';
require_once(__DIR__.'/../MODEL/Notification.php');

class NotificationDao extends db{
    public function createNotification(Notification $notification){
        $s_id = $notification->getSId();
        $o_ref = $notification->getORef();
        $e_id = $notification->getEId();
        $p_id = $notification->getPId();
        $p_qty = $notification->getPQty();
        $unity_id = $notification->getUnityId();

        $query = "INSERT INTO notification_order(s_id,o_ref,e_id,p_id,p_qty,unity_id) VALUE(?,?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
           $s_id,
           $o_ref,
           $e_id,
           $p_id,
           $p_qty,
           $unity_id
        ));
        return $result;
    }


    public function countNotification(Notification $notification){
        $s_id = $notification->getSId();
        $query = "SELECT * FROM notification_order WHERE s_id = ? AND status = '0'";
        $statement = $this->connect()->prepare($query);
        $statement->execute([
            $s_id
        ]);
        $result = $statement->rowCount();
        return $result;
    }

    public function selectNotification(Notification $notification){
        $s_id = $notification->getSId();
        $query = "SELECT employees.*,sessions.*,products.*,notification_order.* FROM notification_order JOIN employees 
        ON employees.e_id = notification_order.e_id JOIN sessions 
        ON sessions.s_id = notification_order.s_id JOIN products ON products.p_id = notification_order.p_id WHERE  notification_order.s_id = ? ORDER BY notification_order.n_id DESC";

        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_id
        ));

        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
            return $result;
        }
      

    }


    public function updateNotificationDisable(Notification $notification){
        $n_id = $notification->getNId();
        $query = "UPDATE notification_order  SET status = '1'  WHERE notification_order.n_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
           $n_id 
        ));
        return $result;
    }
    
    public function updateNotificationEnable(Notification $notification){
        $n_id = $notification->getNId();
        $query = "UPDATE notification_order  SET status = '0'  WHERE notification_order.n_id = ?";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
           $n_id 
        ));
        return $result;
    }


}

?>