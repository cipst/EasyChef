<?php
require_once("../../php/common.php");
require_once("../../php/dao/recipes.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);


session_start();

if (!isset($_SESSION["role"]))
    return response(401, ["error" => "Unauthorized request!"]);

try {
    checkData($_POST);

    $recipe_id = strip_tags($_POST["recipe_id"]);
    $chef_id = strip_tags($_POST["chef_id"]);

    $recipe_response = setLike(
        $recipe_id,
        $chef_id,
    );

    return response(200, ["ok" => "Like $recipe_response"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}