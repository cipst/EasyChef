<?php
require_once("../../php/common.php");
require_once("../../php/dao/chefs.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET")
    return response(300, ["error" => "Invalid request method!"]);

try {
    $response = getAllChefs();

    if(!$response)
        return response(300, ["error" => "No chefs found!"]);

    $chefs = array();
    foreach ($response as $chef) {
        $chefs[] = $chef["name"];
    }

    return response(200, ["chefs" => json_encode($chefs)]);
} catch (Exception $e) {
    return response(300, ["error" => $e->getMessage()]);
} catch (Error $e) {
    return response(500, ["error" => $e->getMessage()]);
}