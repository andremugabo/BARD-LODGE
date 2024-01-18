<?php
session_start();
require_once '../DAO/SessionsDao.php';
require_once '../DAO/MetricDao.php';


$action = $_GET['action'];
$sessionObj = new Sessions();
$sessionDaoObj = new SessionsDao();
$metricDaoObj = new MetricDao();
$metricObj = new Metric();


switch($action){
    case 'insert':
        if(isset($_POST['addSession']))
        {
            $feedback = $sessionDaoObj->checkOpenSessions();
            // echo $feedback;
            if($feedback === 0)
            {
                $count = $sessionDaoObj->countSessions() + 1;
                // echo $count;
                $date = date('D/d-M-Y');
                // echo $date;
                if($count < 10 )
                {
                    $s_ref = "SESSION-".$date."-000".$count;
                }
                else if($count >= 10 && $count < 100)
                {
                    $s_ref = "SESSION-".$date."-00".$count;
                }
                else if($count >= 100 && $count < 1000)
                {
                    $s_ref = "SESSION-".$date."-0".$count;
                }
                else
                {
                    $s_ref = "SESSION-".$date."-".$count;
                }
                // echo $s_ref;
                if(!empty($s_ref))
                {
                    //create metric 
                //set user id for metric 
                $metricObj->setEId($_SESSION['logged']['E_ID']);
                $mDesc = " CREATED A SESSION ".$s_ref;
                $metricObj->setMDesc($mDesc);
               //to review after sessions(Done)
               if(isset( $_SESSION['currentSession']))
               {
                $metricObj->setSId($_SESSION['currentSession']);

               }
               else
               {
                   $metricObj->setSId(null);
               }
                $_SESSION['success_msg'] = $s_ref." CREATED SUCCESSFULLY!!!";
                $sessionObj->setSRef($s_ref);
                $sessionDaoObj->createSession($sessionObj);
                $metricDaoObj->createMetric($metricObj);

                header("location:{$_SERVER['HTTP_REFERER']}");   
                }
                else
                {
                    $_SESSION['fail_msg']="FAILED TO CREATE SESSION !!";
                    header("location:{$_SERVER['HTTP_REFERER']}");
                }

            }
            else
            {
                $_SESSION['fail_msg']="THERE IS AN OPEN SESSION !!";
                header("location:{$_SERVER['HTTP_REFERER']}");
            }

        }
        else
        {
            $_SESSION['fail_msg']="YOU ARE NOT AUTHORIZED TO CREATE A SESSION";
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
        break;
    case 'close':
        break;
    default:
        header('location:../../');
        session_destroy();    
        break;     

    }








?>