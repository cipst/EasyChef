<?php
require_once("../../php/common.php");
require_once("../../php/functions.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

$response = getAllCookingMethods();

$methods = array();
foreach ($response as $method) {
    $methods[] = $method["name"];
}
return response(200, "success", ["methods" => json_encode($methods)]);