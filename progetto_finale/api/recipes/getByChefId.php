<?php
require_once("../../php/common.php");
require_once("../../php/dao/recipes.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    $chef_id = strip_tags($_POST["chef_id"]);

    $recipe = getRecipesByChefId($chef_id);

    $recipes = array();
    foreach ($recipe as $index => $recipe) {
        $id = $recipe["id"];

        $likes = createArray(getChefsLikeByRecipe($id), "chef");
        $ingredients = createArray(getIngredientsByRecipe($id), "ingredient");

        $recipes[$index]["id"] = $id;
        $recipes[$index]["chef_id"] = $recipe["chef_id"];
        $recipes[$index]["title"] = $recipe["title"];
        $recipes[$index]["procedure"] = $recipe["procedure"];
        $recipes[$index]["category"] = $recipe["category"];
        $recipes[$index]["cooking_method"] = $recipe["cooking_method"];
        $recipes[$index]["portions"] = $recipe["portions"];
        $recipes[$index]["cooking_time"] = $recipe["cooking_time"];
        $recipes[$index]["ingredients"] = $ingredients;
        $recipes[$index]["likes"] = $likes;
    }

    return response(200, ["recipes" => json_encode($recipes)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}