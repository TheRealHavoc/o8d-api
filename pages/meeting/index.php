<?php
    $auth = Auth::authenticateByToken($db);

    /**
     * Include controllers
     */
    require_once('app/controllers/MeetingController.php');

    if(!$meetingData = $meetingController->index($auth['id'], $auth['role']))
        Response::error("Something went wrong",500);

    Response::success($meetingData);