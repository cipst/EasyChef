<?php
require_once("../../php/common.php");
require_once("../../php/dao/recipes.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    checkData($_GET);

    $id = $_GET["id"];
    $response = getRecipeById($id);

    if (!$response)
        return response(300, "error", ["error" => "No recipe found!"]);

    $likes = createArray(getChefsLikeByRecipe($id), "chef");
    $ingredients = createArray(getIngredientsByRecipe($id), "ingredient");
    $chef = getChefById($response["chef_id"]);

    $recipe["id"] = $id;
    $recipe["chef"] = $chef["name"];
    $recipe["chef_id"] = $response["chef_id"];
    $recipe["title"] = $response["title"];
    $recipe["procedure"] = $response["procedure"];
    $recipe["category"] = $response["category"];
    $recipe["cooking_method"] = $response["cooking_method"];
    $recipe["portions"] = $response["portions"];
    $recipe["cooking_time"] = $response["cooking_time"];
    $recipe["ingredients"] = $ingredients;
    $recipe["likes"] = $likes;

    return response(200, "success", ["recipe" => json_encode($recipe)]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, "error", ["error" => $e->getMessage()]);
}