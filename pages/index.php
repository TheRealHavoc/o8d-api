<?php
    $data = (object) array();

    $data->file = basename(__FILE__);

    Response::go(
        ['result' => $data]
    );
?>