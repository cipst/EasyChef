<?php
function isPOSTValid(array $params)
{
    $msgs = [];
    foreach ($params as $param) {
        if (!isset($_POST[$param])) {
            array_push($msgs, "$param is missing!");
        } else if (empty($_POST[$param])) {
            array_push($msgs, "$param must not be empty!");
        }
    }

    return $msgs;
}

function response(int $code, string $status, $data = null)
{
    http_response_code($code);
    $response = [
        "status" => $status,
    ];
    $response = array_merge($response, $data);
    return print(json_encode($response));
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