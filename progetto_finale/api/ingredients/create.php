<?php
require_once("../../php/common.php");
require_once("../../php/dao/ingredients.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    checkData($_POST);
    
    createIngredient($_POST["name"]);

    return response(200, "success", ["ok" => "Ingredient created!"]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch(Error $e){
    return response(500, "error", ["error" => $e->getMessage()]);
}