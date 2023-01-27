<?php
require_once("../../php/common.php");
require_once("../../php/dao/recipes.php");

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
    return response(300, "error", ["errors" => ["Invalid request method!"]]);

try {
    $recipe = setLike(
        $_POST["recipe_id"],
        $_POST["chef_id"],
    );

    return response(200, "success", ["ok" => "Like $recipe"]);
} catch (Exception $e) {
    return response(300, "error", ["errors" => [$e->getMessage()]]);
} catch(Error $e){
    return response(500, "error", ["errors" => [$e->getMessage()]]);
}