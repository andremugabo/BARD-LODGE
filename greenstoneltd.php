<?php 

function base(){
    echo str_replace("greenstoneltd.php","",$_SERVER['PHP_SELF']);
}
?>
<?php require_once"INCLUDES/header.php";  ?>
<?php require("url_controler.php"); ?>
<?php  require_once"INCLUDES/footer.php";  ?>