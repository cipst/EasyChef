<?php
require_once("../php/common.php");
require_once("../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    session_start();

    $response = getChefByEmailAndPassword($_POST['email'], $_POST['password']);

    if (!$response)
        return response(300, "error", ["error" => "No chef found!"]);

    $_SESSION["id"] = $response["id"];
    $_SESSION["name"] = $response["name"];
    $_SESSION["email"] = $response["email"];

    return response(200, "success", ["chef" => json_encode($_SESSION)]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, "error", ["error" => $e->getMessage()]);
}