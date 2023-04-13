<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    checkData($_GET);

    $response = getNumberLikeByChef($_GET["id"]);

    if (!$response)
        return response(300, ["error" => "No chef found!"]);

    return response(200, ["count" => json_encode($response[0]["count"])]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}