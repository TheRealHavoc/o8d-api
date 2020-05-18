<?php
    $auth = Auth::authenticateByToken($db, 3);

    /**
     * Include controllers
     */
    require_once('app/controllers/MeetingController.php');

    if(!$meetingController->cancelMeeting())
        Response::error("Something went wrong",500);

    Response::success("Meeting canceled.");