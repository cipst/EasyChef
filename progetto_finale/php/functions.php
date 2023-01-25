<?php
require_once("common.php");

function getAllIngredients()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM ingredient ORDER BY name');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllCookingMethods()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM cooking_method ORDER BY name');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllRecipes()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM recipe');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllChefs()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM chef');
    $stmt->execute();
    return $stmt->fetchAll();
}