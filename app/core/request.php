<?php
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    if(isset($router->page)) {
        $request = json_decode(file_get_contents("php://input"));
    } else {
        $router->page = 'pages/error/404.php';
    }

    require_once($router->page);
?>