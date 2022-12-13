<?php

require_once("utils/top.php");

if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true)
    header("Location: home.php");
?>

<?php require_once("utils/html/login.html"); ?>
<?php require_once("utils/html/sign_up.html"); ?>

<?php include_once("utils/html/bottom.html"); ?>