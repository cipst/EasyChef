<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    $response = getAllChefs();

    if(!$response)
        return response(300, ["error" => "No chefs found!"]);

    $chefs = array();
    foreach ($response as $index => $chef) {
        $chefs[$index]["id"] = $chef["id"];
        $chefs[$index]["role"] = $chef["role"];
        $chefs[$index]["name"] = $chef["name"];
        $chefs[$index]["email"] = $chef["email"];
        $chefs[$index]["password"] = $chef["password"];
    }

    return response(200, ["chefs" => json_encode($chefs)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}