<?php
    $url = array_slice(explode("/", $_SERVER['REQUEST_URI']), 1);

    switch($url[0]) {

        case 'api':
            $requestedPage = 'pages/api.php';
            break;
        case '':
            $requestedPage = 'pages/docs.php';
        break;

        default:
            $requestedPage = 'pages/docs.php';
        break;
    }
?>