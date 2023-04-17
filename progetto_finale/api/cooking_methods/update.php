<?php
require_once("../../php/common.php");
require_once("../../php/dao/cooking_methods.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

session_start();

if (!isset($_SESSION["role"]))
    return response(401, ["error" => "Unauthorized request!"]);

try {
    checkData($_POST);

    if (updateCookingMethod($_POST["oldCookingMethod"], $_POST["newCookingMethod"]))
        return response(200, ["ok" => "Cooking Method updated!"]);
    else
        return response(300, ["error" => "Cooking Method not updated!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}