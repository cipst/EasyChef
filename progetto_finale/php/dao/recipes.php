<?php
/**
 * This file is used to manage the recipes from the database
 * Here there are all the operations that can be done on the recipes
 * 
 * @author: Stefano Cipolletta
 * */

require_once("ingredients.php");

function getAllRecipes()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipe');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getChefsLikeByRecipe($recipe)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT chef FROM likes WHERE recipe = ?');
    $stmt->execute([$recipe]);
    return $stmt->fetchAll();
}

function setLike($recipe, $chef)
{
    $db = DBconnection();
    // check if the chef has already liked the recipe
    $stmt = $db->prepare('SELECT * FROM likes WHERE recipe = ? AND chef = ?');
    $stmt->execute([$recipe, $chef]);
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
        // if the chef has already liked the recipe, remove the like
        $stmt = $db->prepare('DELETE FROM likes WHERE recipe = ? AND chef = ?');
        $stmt->execute([$recipe, $chef]);
        return "removed";
    }
    // if the chef has not liked the recipe, add the like
    $stmt = $db->prepare('INSERT INTO likes (recipe, chef) VALUES (?, ?)');
    $stmt->execute([$recipe, $chef]);
    return "added";
}

function createRecipe(int $chef_id, string $title, string $procedure, string $category, string $cooking_method, int $portions, int $cooking_time, array $ingredients)
{
    $db = DBconnection();
    $stmt = $db->prepare('INSERT INTO recipe (id, chef_id, title, `procedure`, category, cooking_method, portions, cooking_time) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$chef_id, $title, $procedure, $category, $cooking_method, $portions, $cooking_time]);
    $recipe_id = $db->lastInsertId();
    insertIngredientsRecipe($recipe_id, $ingredients);
}

function getRecipeById($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipe WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getRecipesByIngredient($ingredient)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipe WHERE id IN (SELECT recipe FROM ingredients_list WHERE ingredient = ?)');
    $stmt->execute([$ingredient]);
    return $stmt->fetchAll();
}

function getRecipesByCookingMethod($cooking_method)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipe WHERE cooking_method = ?');
    $stmt->execute([$cooking_method]);
    return $stmt->fetchAll();
}

function getRecipesByChefId($chef_id){
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipe WHERE chef_id = ?');
    $stmt->execute([$chef_id]);
    return $stmt->fetchAll();
}

function getRecipesLikedByChefId($chef_id){
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipe WHERE id IN (SELECT recipe FROM likes WHERE chef = ?)');
    $stmt->execute([$chef_id]);
    return $stmt->fetchAll();
}

function deleteRecipe($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('DELETE FROM recipe WHERE id = ?');
    return $stmt->execute([$id]);
}