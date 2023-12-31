<?php
$url = explode('/', $_SERVER['QUERY_STRING']);
// print_r($url) ;
$DASHBOARD = "PAGES/DASHBOARD/";
$EMPLOYEES = "PAGES/EMPLOYEES/";
$SESSIONS = "PAGES/SESSIONS/";
$PRODUCTS = "PAGES/PRODUCTS/";

if (file_exists($DASHBOARD . $url[0] . '.php')) {
    if ($url[0] == 'home' || $url[0] == 'index') {
        require_once $DASHBOARD.'index.php';
        
    } else {
        require_once $DASHBOARD . $url[0] . '.php';
    }
}elseif (file_exists($EMPLOYEES . $url[0] . '.php')) {
    require_once $EMPLOYEES. $url[0] . '.php';
}elseif (file_exists($PRODUCTS . $url[0] . '.php')) {
    require_once $PRODUCTS . $url[0] . '.php';
}elseif (file_exists($SESSIONS . $url[0] . '.php')) {
    require_once $SESSIONS . $url[0] . '.php';
}elseif(empty($url[0])){
    require_once $DASHBOARD.$url[0].'index.php';
}else{
    require_once $DASHBOARD.'error.php';
}



?>