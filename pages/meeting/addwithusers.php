<?php
    $auth = Auth::authenticateByToken($db, 3);

    /**
     * Include controllers
     */
    require_once('app/controllers/MeetingController.php');
    require_once('app/controllers/BlockController.php');

    if(!$meetingID = $meetingController->addMeeting())
        Response::error("Something went wrong",500);

    if(!$blockController->addUsersBulk($meetingID))
        Response::error("Something went wrong",500);

    Response::success("Meeting added with users.");