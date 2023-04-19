<?php
require_once("../../php/common.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    session_start();

    if (isset($_SESSION["id"])) {
        session_unset();
        session_destroy();
        return response(200, ["user" => json_encode(null)]);
    }

    return response(300, ["error" => "You are not logged in!"]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}