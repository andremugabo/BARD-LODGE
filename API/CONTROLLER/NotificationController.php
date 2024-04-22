<?php
session_start();
require_once '../DAO/OrdersDao.php';
require_once '../DAO/MetricDao.php';
require_once '../DAO/NotificationDao.php';


$action = $_GET['action'];
$orderDao = new OrdersDao();
$orderObj = new Orders();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();
$notificationDao = new NotificationDao();
$notificationObj = new Notification();


switch ($action) {
    case 'disable':
        $n_id = $_GET['n_id'];
        $p_name = $_GET['p_name'];
        $notificationObj->setNId($n_id);
        $notificationDao->updateNotificationDisable($notificationObj);

        $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = $p_name."  SERVED SUCCESSFULLY !! ";
            $metricObj->setMDesc($mDesc);
            //to review after sessions(Done)
            if(isset($_SESSION['currentSession']))
            {
                $metricObj->setSId($_SESSION['currentSession']);

            }
            else
            {
                $metricObj->setSId(null);
            }
            $_SESSION['success_msg'] =$p_name." SERVED SUCCESSFULLY!!!";
            $metricDaoObj->createMetric($metricObj);
            header("location:{$_SERVER['HTTP_REFERER']}");
        break;
    case 'enable':
        $n_id = $_GET['n_id'];
        $notificationObj->setNId($n_id);
        $notificationDao->updateNotificationEnable($notificationObj);

        $metricObj->setEId($_SESSION['logged']['E_ID']);
            $mDesc = "ACTION REVERSED ".$p_name." NEED TO BE SERVED ";
            $metricObj->setMDesc($mDesc);
            //to review after sessions(Done)
            if(isset($_SESSION['currentSession']))
            {
                $metricObj->setSId($_SESSION['currentSession']);

            }
            else
            {
                $metricObj->setSId(null);
            }
            $_SESSION['success_msg'] =" ACTION REVERSED ";
            $metricDaoObj->createMetric($metricObj);
            header("location:{$_SERVER['HTTP_REFERER']}");
        break;
    default:
        
        break;
}



?>