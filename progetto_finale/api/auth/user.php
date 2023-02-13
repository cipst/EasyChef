<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    session_start();

    if (isset($_SESSION["id"])) {
        session_destroy();
        return response(200, "success", ["user" => json_encode(null)]);
    }

    $response = getChefByEmail($_POST['email']);

    if (!$response)
        return response(300, "error", ["error" => "Email not found!"]);

    if ($response["password"] != $_POST['password'])
        return response(300, "error", ["error" => "Password not correct!"]);

    $_SESSION["id"] = $response["id"];
    $_SESSION["name"] = $response["name"];
    $_SESSION["email"] = $_POST['email'];

    return response(200, "success", ["user" => json_encode($_SESSION)]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, "error", ["error" => $e->getMessage()]);
}