<?php include_once("utils/top.php"); ?>
<?php include_once("utils/nav_bar.html"); ?>
<?php
$_SESSION["alert"] = new Alert(AlertType::SUCCESS, "REFERENCE SITE", "https://www.facebook.com/", "");
for ($i = 0; $i < 100; $i++) {
?>
    <br>
<?php
}
?>
<?php include_once("utils/bottom.html"); ?>