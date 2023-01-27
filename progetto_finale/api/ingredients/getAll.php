<?php
require_once("../../php/common.php");
require_once("../../php/dao/ingredients.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

$recipe = getAllIngredients();

$ingredients = array();
foreach ($recipe as $ingredient) {
    $ingredients[] = $ingredient["name"];
}

return response(200, "success", ["ingredients" => json_encode($ingredients)]);