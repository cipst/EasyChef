<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    session_start();

    if (isset($_SESSION["id"])) {
        session_destroy();
        return response(200, ["user" => json_encode(null)]);
    }

    $response = getChefByEmail($_POST['email']);

    if (!$response)
        return response(300, ["error" => "Email not found!"]);

    if ($response["password"] != $_POST['password'])
        return response(300, ["error" => "Password not correct!"]);

    $_SESSION["id"] = $response["id"];
    $_SESSION["name"] = $response["name"];
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["role"] = $response["role"];

    return response(200, ["user" => json_encode($_SESSION)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}