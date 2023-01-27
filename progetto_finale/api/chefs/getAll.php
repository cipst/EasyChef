<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

$recipe = getAllChefs();

$recipes = array(); 
foreach ($recipe as $recipe) {
    $recipes[] = $recipe["name"];
}

return response(200, "success", ["chefs" => json_encode($recipes)]);