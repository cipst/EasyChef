<?php
require_once("../../php/common.php");
require_once("../../php/dao/recipes.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "USER")
    return response(401, ["error" => "Unauthorized request!"]);

try {
    checkData($_POST);

    $all = getAllRecipes();

    foreach($all as $recipe){
        if (strtolower($recipe["title"]) == strtolower($_POST["title"]))
            return response(300, ["error" => "This recipe already exists!"]);
    }

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

    return response(200, ["ok" => "Recipe created!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}