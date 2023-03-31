<?php
require_once("../../php/common.php");
require_once("../../php/dao/ingredients.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "USER")
    return response(401, ["error" => "Unauthorized request!"]);
    
try {
    checkData($_POST);

    createIngredient($_POST["name"]);

    return response(200, ["ok" => "Ingredient added!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}