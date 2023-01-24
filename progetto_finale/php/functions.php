<?php
require_once("common.php");

function getAllIngredients()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM ingredients');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllCookingMethods()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM cooking_methods');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllRecipes()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipes');
    $stmt->execute();
    return $stmt->fetchAll();
}