<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    $email = strip_tags($_POST['email']);
    $name = strip_tags($_POST['name']);
    $password = strip_tags($_POST['password']);

    $all = getAllChefs();

    foreach ($all as $chef) {
        if (strtolower($chef["name"]) == strtolower($name))
            return response(300, ["error" => "Chef name already exists!"]);

        if (strtolower($chef["email"]) == strtolower($email))
            return response(300, ["error" => "Email already exists!"]);
    }

    $password = hash("sha256", $password);

    $id = setChef($name, $email, $password);

    if (!$id)
        return response(300, ["error" => "Chef not created!"]);

    session_start();

    $_SESSION["id"] = $id;
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["role"] = "USER";

    return response(200, ["ok" => "Chef created!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}