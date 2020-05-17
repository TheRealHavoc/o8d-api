<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/CalendarController.php');

    $auth = Auth::authenticateByToken($db, 3);

    if($calendarController->editDate()) {
        Response::success("Resource edited.");
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }