<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    session_start();

    if (!isset($_SESSION["id"]))
        return response(200, ["user" => json_encode(null)]);

    return response(200, ["user" => json_encode($_SESSION)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}