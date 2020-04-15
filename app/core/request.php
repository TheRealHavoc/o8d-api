<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    if(isset($response)) {
        $request = json_decode(file_get_contents("php://input"));

        require_once ('app/functions/response.php');
    } else {
        $response = 'base/pages/error.php';
    }

    require_once($response);
?>