<?php
    $data = (object) array();

    $data->file = basename(__FILE__);

    if($data) {
        Response::success(
            $data
        );
    } else {
        Response::error(
            "Could not find requested data.",
            404
        );
    }
?>