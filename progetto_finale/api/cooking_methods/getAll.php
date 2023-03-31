<?php
require_once("../../php/common.php");
require_once("../../php/dao/cooking_methods.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    $recipe = getAllCookingMethods();

    if (!$recipe)
        return response(300, ["error" => "No cooking methods found!"]);

    $methods = array();
    foreach ($recipe as $method) {
        $methods[] = $method["name"];
    }
    return response(200, ["methods" => json_encode($methods)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}