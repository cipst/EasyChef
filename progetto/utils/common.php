<?php
function isValid(array $params)
{
    $msgs = [];
    foreach ($params as $param) {
        if (!isset($_POST[$param])) {
            array_push($msgs, "$param is missing!");
        } else if (empty($_POST[$param])) {
            array_push($msgs, "$param must not be empty!");
        }
    }

    return $msgs;
}

function response($code, $status, $data = null)
{
    http_response_code($code);
    $response = [
        "status" => $status,
    ];
    $response = array_merge($response, $data);
    return print(json_encode($response));
}