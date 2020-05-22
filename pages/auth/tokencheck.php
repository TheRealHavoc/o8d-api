<?php
    if(!$auth = Auth::authenticateByToken($db))
        Response::error("Nothing found",404);

    Response::success($auth);