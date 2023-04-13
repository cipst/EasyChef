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

function setCookingMethod($cooking_method){
    $db = DBconnection();
    $stmt = $db->prepare('INSERT INTO cooking_method (name) VALUES (?)');
    return $stmt->execute([$cooking_method]);
}

function deleteCookingMethod($cooking_method){
    $db = DBconnection();
    $stmt = $db->prepare('DELETE FROM cooking_method WHERE name = ?');
    return $stmt->execute([$cooking_method]);
}