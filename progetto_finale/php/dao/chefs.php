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
    $stmt = $db->prepare('SELECT id, `name`, email, `role`, `password` FROM chef');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getChefById($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT `name`, `email`, `role` FROM chef WHERE id = ?');
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function getChefByEmail($email)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT id, `name`, `password`, `role` FROM chef WHERE email = ?');
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch();
}

function setChef($name, $email, $passowrd)
{
    $db = DBconnection();
    $stmt = $db->prepare('INSERT INTO chef (`name`, `email`, `password`) VALUES (?, ?, ?)');

    $name = strtolower($name);
    $email = strtolower($email);
    $passowrd = strtolower($passowrd);

    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $passowrd, PDO::PARAM_STR);

    $stmt->execute();
    return $db->lastInsertId();
}

function deleteChef($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('DELETE FROM chef WHERE id = ?');
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    return $stmt->execute();
}

function getNumberRecipesByChef($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT COUNT(*) as `count` FROM recipe WHERE chef_id = ?');
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function getNumberLikeByChef($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT COUNT(*) as `count` FROM (SELECT id FROM recipe WHERE chef_id = ?) as tmp JOIN likes ON tmp.id = likes.recipe');
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}