<?php
    class MeetingController
    {
        private $conn;

        /**
         * MeetingController constructor.
         * @param $db
         */
        public function __construct($db)
        {
            $this->conn = $db->conn;
        }

        /**
         * @return bool
         */
        public function addMeeting()
        {
            // TODO
            // - Add validation for date and time inputs
            // - Add check for if a meeting is already planned in a room
            // - Add check for if a coach is already planned

            if (
                !isset($_POST['date']) ||
                !isset($_POST['startTime']) ||
                !isset($_POST['endTime']) ||
                !isset($_POST['coach']) ||
                !isset($_POST['room'])
            ) Response::error("Not enough form data.", 400);

            $q = "INSERT INTO `meetings` (`id`, `date`, `start_time`, `end_time`, `coach`, `room`) VALUES (NULL, :date, :startTime, :endTime, :coach, :room);";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':date', $_POST['date']);
            $sql->bindParam(':startTime', $_POST['startTime']);
            $sql->bindParam(':endTime', $_POST['endTime']);
            $sql->bindParam(':coach', $_POST['coach']);
            $sql->bindParam(':room', $_POST['room']);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            return $this->conn->lastInsertId();
        }

        /**
         * @return bool
         */
        public function cancelMeeting()
        {
            // TODO
            // - Add check to see if already canceled
            // - Add check to see if meeting exists

            if (!isset($_POST['id']))
                Response::error("Not enough form data.", 400);

            $q = "UPDATE `meetings` SET `canceled` = '1' WHERE `meetings`.`id` = :id";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':id', $_POST['id']);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            return true;
        }
    }

    $meetingController = new MeetingController($db);