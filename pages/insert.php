<?php

    $data = $db->insertDate();

    if($data) {
        Response::success(
            $data
        );
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }

?>