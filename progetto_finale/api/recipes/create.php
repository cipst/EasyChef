<?php
require_once("../../php/common.php");
require_once("../../php/dao/recipes.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    createRecipe(
        $_POST["chef_id"],
        $_POST["title"],
        $_POST["procedure"],
        $_POST["category"],
        $_POST["cooking_method"],
        $_POST["portions"],
        $_POST["cooking_time"],
        $_POST["ingredients"]
    );

    return response(200, "success", ["ok" => "Recipe created!"]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, "error", ["error" => $e->getMessage()]);
}