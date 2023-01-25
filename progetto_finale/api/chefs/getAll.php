<?php
require_once("../../php/common.php");
require_once("../../php/functions.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

$response = getAllChefs();

$chefs = array(); 
foreach ($response as $chef) {
    $chefs[] = $chef["name"];
}

return response(200, "success", ["chefs" => json_encode($chefs)]);