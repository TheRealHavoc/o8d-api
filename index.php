<?php
    $url = array_slice(explode("/", $_SERVER['REQUEST_URI']), 1);

    var_dump($url[0]);

    switch($url[0]) {

        case 'api':
            $next = 'pages/api.php';
            break;
        case '':
            $next = 'pages/docs.php';
        break;

        default:
            $next = 'pages/docs.php';
        break;
    }
?>

<?php echo 'index.php'; ?>

<ul>
    <li><a href="/">Docs</a></li>
    <li><a href="/api">Api</a></li>
</ul>

<?php
    require($next);
?>