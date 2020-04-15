<?php

    $url = array_slice(explode("/", $_SERVER['REQUEST_URI']), 1);

    switch($url[0]) {

        case 'api':
            $response = 'pages/api.php';
            break;

        default:
            $response = 'pages/docs.php';
        break;
    }
?>