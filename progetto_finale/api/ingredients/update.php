<?php
require_once("../../php/common.php");
require_once("../../php/dao/ingredients.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

session_start();

if (!isset($_SESSION["role"]))
    return response(401, ["error" => "Unauthorized request!"]);

try {
    checkData($_POST);

    $oldIngredient = strip_tags($_POST["oldIngredient"]);
    $newIngredient = strip_tags($_POST["newIngredient"]);

    if (updateIngredient($oldIngredient, $newIngredient))
        return response(200, ["ok" => "Ingredient updated!"]);
    else
        return response(300, ["error" => "Ingredient not updated!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}