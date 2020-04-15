<?php

    $url = array_slice(explode("/", $_SERVER['REQUEST_URI']), 1);

    switch($url[0]) {
        case '':
            $response = 'pages/index.php';
            break;

        default:
            $response = 'pages/error/404.php';
        break;
    }
?>