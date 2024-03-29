<?php
require_once("../../php/common.php");
require_once("../../php/dao/ingredients.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    $recipe = getAllIngredients();
    
    if (!$recipe)
        return response(300, ["error" => "No ingredients found!"]);

    $ingredients = array();
    foreach ($recipe as $ingredient) {
        $ingredients[] = $ingredient["name"];
    }

    return response(200, ["ingredients" => json_encode($ingredients)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}