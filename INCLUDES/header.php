<?php
session_start();




$employee_fnames = $_SESSION['logged']['FIRSTNAME'];
$employee_lnames = $_SESSION['logged']['LASTNAME'];
$employee_names = $employee_fnames." ".$employee_lnames;
$employee_role = $_SESSION['logged']['E_ROLE'];
$employee_phone = $_SESSION['logged']['E_PHONE'];
// // echo $employee_role;

if ($employee_fnames == null || $employee_role == null) {
    header("location:./");
    session_destroy();
}

// Get the full URL
$currentUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL to get the query string
$urlParts = parse_url($currentUrl);
$queryString = isset($urlParts['query']) ? $urlParts['query'] : '';

// Parse the query string into an associative array
parse_str($queryString, $queryParams);

// Access specific query parameters
$logoutValue = isset($queryParams['logout']) ? $queryParams['logout'] : '';

if ($logoutValue) {
    header("location:./");
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="ASSETS/SIMAGES/greenog.png">
    <link href="ASSETS/CSS/general.css" rel="stylesheet">

    <title>GREEN STONE LTD</title>


</head>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <ul class="navbar-nav navbar-align ">

                    <li class="nav-item d-flex ">
                        <h6>
                            <?=$employee_names?>
                        </h6>
                    </li>
                    <li class="nav-item"><button class="btn " onclick="window.location.href='?logout=1'">Logout</button>
                    </li>
                </ul>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="w-100">