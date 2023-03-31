<?php

function checkData($post)
{
    if (!isset($post))
        throw new Exception("Missing data!");

    if (count($post) == 0)
        throw new Exception("Missing data!");

    foreach ($post as $key => $value) {
        if (!isset($value))
            throw new Exception("Missing $key!");

        if (empty($value))
            throw new Exception("Invalid $key!");
    }
}

function response(int $code, $data = null)
{
    http_response_code($code);
    return print(json_encode($data));
}

function DBconnection()
{
    $dbconnstring = 'mysql:dbname=easychef;host=localhost:3306';
    $dbuser = 'root';
    $dbpasswd = '';

    $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function createArray($array, $key)
{
    $newArray = array();
    foreach ($array as $index => $item) {
        $newArray[$index] = $item[$key];
    }
    return $newArray;
}