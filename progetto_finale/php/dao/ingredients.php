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
    foreach ($ingredients as $ingredient) {
        $stmt->execute([$recipe, $ingredient]);
    }    
}

function getIngredientsByRecipe($recipe)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT ingredient FROM ingredients_list WHERE recipe = ?');
    $stmt->execute([$recipe]);
    return $stmt->fetchAll();
}