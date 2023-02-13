<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    $all = getAllChefs();

    foreach ($all as $chef) {
        if (strtolower($chef["name"]) == strtolower($_POST["name"]))
            return response(300, "error", ["error" => "Chef name already exists!"]);

        if (strtolower($chef["email"]) == strtolower($_POST["email"]))
            return response(300, "error", ["error" => "Email already exists!"]);
    }

    $id = setChef($_POST["name"], $_POST["email"], $_POST["password"]);

    if (!$id)
        return response(300, "error", ["error" => "Chef not created!"]);

    session_start();

    $_SESSION["id"] = $id;
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["email"] = $_POST['email'];

    return response(200, "success", ["ok" => "Chef created!"]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, "error", ["error" => $e->getMessage()]);
}