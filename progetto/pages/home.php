<?php
include_once("../utils/top.php");
include_once("../utils/nav_bar.php");

$_SESSION["logged"] = true;

nav_bar("home"); //printing the navigation bar for the friends
?>

<?php include_once("../utils/bottom.html"); ?>