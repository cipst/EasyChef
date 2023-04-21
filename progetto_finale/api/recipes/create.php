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
    
    $chef_id = strip_tags($_POST["chef_id"]);
    $title = strip_tags($_POST["title"]);
    $procedure = strip_tags($_POST["procedure"]);
    $category = strip_tags($_POST["category"]);
    $cooking_method = strip_tags($_POST["cooking_method"]);
    $portions = strip_tags($_POST["portions"]);
    $cooking_time = strip_tags($_POST["cooking_time"]);

    $all = getAllRecipes();

    foreach($all as $recipe){
        if (strtolower($recipe["title"]) == strtolower($title))
            return response(300, ["error" => "This recipe already exists!"]);
    }

    createRecipe(
        $chef_id,
        $title,
        $procedure,
        $category,
        $cooking_method,
        $portions,
        $cooking_time,
        $_POST["ingredients"]
    );

    return response(200, ["ok" => "Recipe created!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}