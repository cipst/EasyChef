<?php
require_once("../../php/common.php");
require_once("../../php/dao/cooking_methods.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

$recipe = getAllCookingMethods();

$methods = array();
foreach ($recipe as $method) {
    $methods[] = $method["name"];
}
return response(200, "success", ["methods" => json_encode($methods)]);