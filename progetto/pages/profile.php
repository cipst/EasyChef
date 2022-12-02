<?php
include_once("../utils/top.php");
include_once("../utils/nav_bar.php");

nav_bar("profile"); //printing the navigation bar for the profile
?>


<?php
$_SESSION["logged"] = false;
// $_SESSION["alert"] = new Alert(AlertType::SUCCESS, "REFERENCE SITE", "https://www.facebook.com/", "");
?>
<?php include_once("../utils/bottom.html"); ?>