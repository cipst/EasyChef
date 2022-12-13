<?php

require_once("../../utils/common.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true)
    return response(200, "redirect", ["url" => "./home.php"]);

$msgs = isValid(["username", "email", "password", "confirmPassword"]);
if (count($msgs))
    return response(300, "error", ["errors" => $msgs]);

$email = $_POST['email'];
$password = $_POST['password'];

// if ($email == "admin@a.a" && $password == "admin") {
$_SESSION["logged"] = true;
return response(200, "redirect", ["url" => "./home.php"]);
// }

// return response(300, "error", ["errors" => ["Invalid email or password!"]]);