<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    $response = getAllChefs();

    if(!$response)
        return response(300, "error", ["error" => "No chefs found!"]);

    $recipes = array();
    foreach ($response as $recipe) {
        $recipes[] = $recipe["name"];
    }

    return response(200, "success", ["chefs" => json_encode($recipes)]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, "error", ["error" => $e->getMessage()]);
}