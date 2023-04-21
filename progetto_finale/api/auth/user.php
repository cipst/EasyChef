<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    session_start();

    $response = getChefByEmail($email);

    if (!$response)
        return response(300, ["error" => "Email not found!"]);
        
    $password = hash("sha256", $password);
    if ($response["password"] != $password)
        return response(300, ["error" => "Password not correct!"]);

    $_SESSION["id"] = $response["id"];
    $_SESSION["name"] = $response["name"];
    $_SESSION["email"] = $email;
    $_SESSION["role"] = $response["role"];

    return response(200, ["user" => json_encode($_SESSION)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}