<?php
    if(isset($response)) {
        $request = json_decode(file_get_contents("php://input"));
    } else {
        $response = 'pages/error/error.php';
    }

    require_once($response);
?>