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
    $stmt = $db->prepare('SELECT id, name FROM chef');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getChefById($id)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT `name`, `email` FROM chef WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getChefByEmailAndPassword($email, $password)
{
    $db = DBconnection();
    $stmt = $db->prepare('SELECT id, `name`, email FROM chef WHERE email = ? AND password = ?');
    $stmt->execute([$email, $password]);
    return $stmt->fetch();
}

function setChef($name, $email, $passowrd){
    $db = DBconnection();
    $stmt = $db->prepare('INSERT INTO chef (`name`, `email`, `password`) VALUES (?, ?, ?)');
    return $stmt->execute([$name, $email, $passowrd]);
}