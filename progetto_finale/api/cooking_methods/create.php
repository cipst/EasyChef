<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "ADMIN")
    return response(401, ["error" => "Unauthorized request!"]);

try {
    checkData($_POST);

    $response = setCookingMethod($_POST["name"]);

    if (!$response)
        return response(300, ["error" => "Error while adding cooking method!"]);

    return response(200, ["ok" => "Cooking method added!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}