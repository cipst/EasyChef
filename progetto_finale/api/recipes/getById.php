<?php
require_once("../../php/common.php");
require_once("../../php/dao/recipes.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

$id = $_GET["id"];
$response = getRecipeById($id);

if(!$response)
    return response(300, "error", ["errors" => ["Recipe not found!"]]);

$likes = createArray(getChefsLikeByRecipe($id), "chef");
$ingredients = createArray(getIngredientsByRecipe($id), "ingredient");
$chef = getChefById($response["chef_id"]);

$recipe["id"] = $id;
$recipe["chef"] = $chef["name"];
$recipe["title"] = $response["title"];
$recipe["procedure"] = $response["procedure"];
$recipe["category"] = $response["category"];
$recipe["cooking_method"] = $response["cooking_method"];
$recipe["portions"] = $response["portions"];
$recipe["cooking_time"] = $response["cooking_time"];
$recipe["ingredients"] = $ingredients;
$recipe["likes"] = $likes;

return response(200, "success", ["recipe" => json_encode($recipe)]);