<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    checkData($_GET);

    $response = getChefById($_GET["id"]);

    if (!$response)
        return response(300, ["error" => "No chef found!"]);

    $recipe = array();
    $recipe["name"] = $response["name"];
    $recipe["email"] = $response["email"];

    return response(200, ["chef" => json_encode($recipe)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}