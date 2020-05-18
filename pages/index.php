<?php
    $data = (object) array();

    $data->file = basename(__FILE__);

    if(!$data)
        Response::error("Could not find requested data.",404);

    Response::success($data);
?>