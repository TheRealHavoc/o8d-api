<?php
    $auth = Auth::authenticateByToken($db);

    /**
     * Include controllers
     */
    require_once('app/controllers/BlockController.php');

    if(!$blockController->addUserToBlock($auth['id']))
        Response::error("Something went wrong",500);

    Response::success("User added to block.");