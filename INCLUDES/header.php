<?php 
spl_autoload_register("autoload");

function autoload($className){
    $path = '../../API/DAO/';
    $ext = '.php';
    $fileName =$path . $className .$ext;

    if(!file_exists($fileName)){
        return false;
    }
    include_once $fileName;
}


?>
<?php
session_start();
if(isset($_SESSION['logged']))
{
    $userData = $_SESSION['logged'];
    // print_r($userData['FIRSTNAME']);
    $employee_fnames = $userData['FIRSTNAME'];
    $employee_lnames = $userData['LASTNAME'];
    $employee_names = $employee_fnames." ".$employee_lnames;
    $employee_role = $userData['E_ROLE'];
    $employee_phone = $userData['E_PHONE'];
    $employee_eid = $userData['E_ID'];


    if ($employee_fnames == null || $employee_role == null) {
        header("location:../../");
        session_destroy();
    }
}
else{
    header("location:../../");
}


if (isset($_GET['logout'])) {
    header("location:../../");
    session_destroy();
}

$sessionDao = new SessionsDao();
$sessionInfo = $sessionDao->selectOpenSession();
$countSession = $sessionDao->checkOpenSessions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../../ASSETS/SIMAGES/greenog.png">
    <link href="../../ASSETS/CSS/general.css" rel="stylesheet">

    <title>GREEN STONE LTD</title>


</head>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <ul class="navbar-nav navbar-align ">

                    <li class="nav-item d-flex ">
                        <h6>
                            <?= $employee_names ?>
                        </h6>
                    </li>
                    <li class="nav-item"><button class="btn " onclick="window.location.href='?logout=1'">Logout</button>
                    </li>
                </ul>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="w-100">

                        <div class="msg">
                            <?php 
				if (isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])) {?>
                            <h3 style="background: #0fdd1d7a;padding: 5px;width: 100%;text-align: center;">
                                <?= $_SESSION['success_msg'] ?></h3>
                            <?php  $_SESSION['success_msg']="";  }else if(isset($_SESSION['fail_msg']) && !empty($_SESSION['fail_msg'])){?>
                            <h3 style="background: #b71c1c8f;padding: 5px;width: 100%;text-align: center;">
                                <?= $_SESSION['fail_msg'] ?></h3>
                            <?php $_SESSION['fail_msg']="";	}			
			 ?>
                        </div>