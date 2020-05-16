<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/CalendarController.php');

    if($calendarController->deleteDate()) {
        Response::success("Resource deleted.");
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }