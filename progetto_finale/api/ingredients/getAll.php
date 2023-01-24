<?php
require_once("../../php/common.php");
require_once("../../php/functions.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

// $test = getAllIngredients();
$test = ["carota", "pomodoro", "patata"];
return response(200, "success", ["ingredients" => $test]);