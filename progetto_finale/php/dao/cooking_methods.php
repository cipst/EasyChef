<?php
/**
 * This file is used to manage the cooking methods from the database
 * Here there are all the operations that can be done on the cooking methods
 * 
 * @author: Stefano Cipolletta
 * */

function getAllCookingMethods()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM cooking_method ORDER BY name');
    $stmt->execute();
    return $stmt->fetchAll();
}

function setCookingMethod($cooking_method)
{
    $db = DBconnection();
    $stmt = $db->prepare('INSERT INTO cooking_method (name) VALUES (?)');
    $stmt->bindParam(1, $cooking_method, PDO::PARAM_STR);
    return $stmt->execute();
}

function deleteCookingMethod($cooking_method)
{
    $db = DBconnection();
    $stmt = $db->prepare('DELETE FROM cooking_method WHERE name = ?');
    $stmt->bindParam(1, $cooking_method, PDO::PARAM_STR);
    return $stmt->execute();
}

function updateCookingMethod($old_cooking_method, $new_cooking_method)
{
    $db = DBconnection();
    $stmt = $db->prepare('UPDATE cooking_method SET name = ? WHERE name = ?');
    $stmt->bindParam(1, $new_cooking_method, PDO::PARAM_STR);
    $stmt->bindParam(2, $old_cooking_method, PDO::PARAM_STR);
    return $stmt->execute();
}