<?php
$url = explode('/', $_SERVER['QUERY_STRING']);
// print_r($url) ;
$HOME = "PAGES/";
$API = "API/";
$CONTROLLER = "API/CONTROLLER/";
$DAO = "API/DAO/";
$MODEL = "API/MODEL/";
$DASHBOARD = "PAGES/DASHBOARD/";
$EMPLOYEES = "PAGES/EMPLOYEES/";
$SESSIONS = "PAGES/SESSIONS/";
$PRODUCTS = "PAGES/PRODUCTS/";
$ERROR_PAGE = "PAGES/error.php";

if (file_exists($DASHBOARD . $url[0] . '.php')) {
    if ($url[0] == 'home' || $url[0] == 'greenstoneltd') {
        require_once $DASHBOARD . 'home.php';
    } else {
        require_once $DASHBOARD . $url[0] . '.php';
    }
} elseif (file_exists($EMPLOYEES . $url[0] . '.php')) {
    require_once $EMPLOYEES . $url[0] . '.php';
} elseif (file_exists($PRODUCTS . $url[0] . '.php')) {
    require_once $PRODUCTS . $url[0] . '.php';
} elseif (file_exists($SESSIONS . $url[0] . '.php')) {
    require_once $SESSIONS . $url[0] . '.php';
} elseif (empty($url[0])) {
    require_once $DASHBOARD . $url[0] . 'greenstoneltd.php';
} elseif (file_exists($CONTROLLER . $url[0] . '.php')) {
    require_once $CONTROLLER . $url[0] . '.php';
} elseif (file_exists($DAO . $url[0] . '.php')) {
    require_once $DAO . $url[0] . '.php';
} elseif (file_exists($MODEL . $url[0] . '.php')) {
    require_once $MODEL . $url[0] . '.php';
} else {
    require_once 'error.php';

} 

?>