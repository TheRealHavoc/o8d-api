<?php
    class CalendarController
    {
        private $conn;

        /**
         * CalendarController constructor.
         * @param $db
         */
        public function __construct($db)
        {
            $this->conn = $db->conn;
        }

        /**
         * @return bool
         */
        public function insertDate(){
            if (
                !isset($_POST['student_id']) ||
                !isset($_POST['date']) ||
                !isset($_POST['time']) ||
                !isset($_POST['room'])
            ) Response::error("Not enough form data.", 400);

            $sql = $this->conn->prepare("SELECT * FROM calendar WHERE student_id = ?");

            if(!$sql->execute(array($_POST['student_id'])))
                Response::error("Something went wrong.", 500);

            if($res = $sql->fetch())
                Response::error("Student is already planned in.", 404);

            $sql = $this->conn->prepare("INSERT INTO calendar (student_id, date, time, room) VALUES (?, ?, ?, ?)");

            if(!$sql->execute(array($_POST['student_id'], $_POST['date'], $_POST['time'],  $_POST['room'])))
                Response::error("Something went wrong.", 500);

            return true;
        }

        /**
         * @return bool
         */
        public function deleteDate(){
            if (!isset($_POST['id']))
                Response::error("Not enough form data.", 400);

            $sql = $this->conn->prepare("SELECT * FROM calendar WHERE id = ?");

            if(!$sql->execute(array($_POST['id'])))
                Response::error("Something went wrong.", 500);

            if(!$res = $sql->fetch())
                Response::error("Could not find resource.", 404);

            $sql = $this->conn->prepare("DELETE FROM calendar WHERE id = ?");

            if(!$sql->execute(array($_POST['id'])))
                Response::error("Something went wrong.", 500);

            return true;
        }

        /**
         * @return bool
         */
        public function editDate(){
            if (
                !isset($_POST['student_id']) ||
                !isset($_POST['date']) ||
                !isset($_POST['time']) ||
                !isset($_POST['room'])
            ) Response::error("Not enough form data.", 400);

            $sql = $this->conn->prepare("SELECT * FROM calendar WHERE id = ?");

            if(!$sql->execute(array($_POST['id'])))
                Response::error("Something went wrong.", 500);

            if(!$res = $sql->fetch())
                Response::error("Could not find resource.", 404);

            $sql = $this->conn->prepare("UPDATE calendar SET date = ?, time = ?, room = ? WHERE id = ?");

            if(!$sql->execute(array($_POST['date'], $_POST['time'], $_POST['room'], $_POST['id'])))
                Response::error("Something went wrong.", 500);

            return true;
        }
    }

    $calendarController = new CalendarController($db);