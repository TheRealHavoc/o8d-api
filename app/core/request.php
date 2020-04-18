<?php
    if(isset($router->page)) {
        $request = json_decode(file_get_contents("php://input"));
    } else {
        $router->page = 'pages/error/error.php';
    }

    require_once($router->page);
?>