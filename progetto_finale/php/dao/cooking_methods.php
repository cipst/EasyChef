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