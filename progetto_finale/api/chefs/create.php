<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["error" => "Invalid request method!"]);

try {
    checkData($_POST);

    $response = setChef($_POST["name"], $_POST["email"], $_POST["password"]);

    if (!$response)
        return response(300, "error", ["error" => "No chef found!"]);

    return response(200, "success", ["ok" => "Chef created!"]);
} catch (Exception $e) {
    return response(300, "error", ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, "error", ["error" => $e->getMessage()]);
}