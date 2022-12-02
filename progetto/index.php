<?php
if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true)
    header("Location: pages/home.php");
else
    header("Location: pages/login.php");
