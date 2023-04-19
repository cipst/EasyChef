<?php
/**
 * This file is used to manage the ingredients from the database
 * Here there are all the operations that can be done on the ingredients
 * 
 * @author: Stefano Cipolletta
 * */

function getAllIngredients()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM ingredient ORDER BY name');
    $stmt->execute();
    return $stmt->fetchAll();
}

function insertIngredientsRecipe($recipe, $ingredients)
{
    $db = DBconnection();
    $stmt = $db->prepare('INSERT INTO ingredients_list (recipe, ingredient) VALUES (?, ?)');
    $stmt->bindParam(1, $recipe, PDO::PARAM_INT);
    foreach ($ingredients as $ingredient) {
        $stmt->bindParam(2, $ingredient, PDO::PARAM_STR);
        $stmt->execute();
    }
}

function getIngredientsByRecipe($recipe)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT ingredient FROM ingredients_list WHERE recipe = ?');
    $stmt->bindParam(1, $recipe, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function createIngredient($ingredient)
{
    $db = DBconnection();
    $stmt = $db->prepare('INSERT INTO ingredient (name) VALUES (?)');
    $stmt->bindParam(1, $ingredient, PDO::PARAM_STR);
    return $stmt->execute();
}

function deleteIngredient($ingredient)
{
    $db = DBconnection();
    $stmt = $db->prepare('DELETE FROM ingredient WHERE name = ?');
    $stmt->bindParam(1, $ingredient, PDO::PARAM_STR);
    return $stmt->execute();
}

function updateIngredient($oldIngredient, $newIngredient)
{
    $db = DBconnection();
    $stmt = $db->prepare('UPDATE ingredient SET name = ? WHERE name = ?');
    $stmt->bindParam(1, $newIngredient, PDO::PARAM_STR);
    $stmt->bindParam(2, $oldIngredient, PDO::PARAM_STR);
    return $stmt->execute();
}

function getNumberRecipesByIngredient($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT COUNT(*) as `count` FROM ingredients_list WHERE ingredient = ?');
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}