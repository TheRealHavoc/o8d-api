<?php

    $data = $db->deleteDate();

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