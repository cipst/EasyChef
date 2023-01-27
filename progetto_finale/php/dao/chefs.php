<?php
/**
 * This file is used to manage the chefs from the database
 * Here there are all the operations that can be done on the chefs
 * 
 * @author: Stefano Cipolletta
 * */

function getAllChefs()
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT * FROM chef');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getChefById($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT `name` FROM chef WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}