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
         * @param $userID
         * @param $role
         * @return mixed
         */
        public function index($userID, $role)
        {
            if($role == 1) {
                $q = "SELECT * FROM `meetings` INNER JOIN `blocks` ON `meetings`.`id` = `blocks`.`meeting_id` WHERE `blocks`.`user_id` = :userID";

                $sql = $this->conn->prepare($q);

                $sql->bindParam(':userID', $userID);
            } else {
                $q = "SELECT * FROM `meetings`";

                $sql = $this->conn->prepare($q);
            }

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            if(!$res = $sql->fetchAll())
                Response::error("Could not find meetings linked to user.", 404);

            return $res;
        }

        /**
         * @return bool
         */
        public function addMeeting()
        {
            // TODO
            // - Add validation for date and time inputs
            // - Add check for if a coach is already planned

            if (
                !isset($_POST['date']) ||
                !isset($_POST['startTime']) ||
                !isset($_POST['endTime']) ||
                !isset($_POST['coach']) ||
                !isset($_POST['room'])
            ) Response::error("Not enough form data.", 400);

            $this->checkDuplicate(
                $_POST['date'],
                $_POST['startTime'],
                $_POST['endTime'],
                $_POST['coach'],
                $_POST['room']
            );

            $q = "INSERT INTO `meetings` (`id`, `date`, `start_time`, `end_time`, `coach`, `room`) VALUES (NULL, :date, :startTime, :endTime, :coach, :room);";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':date', $_POST['date']);
            $sql->bindParam(':startTime', $_POST['startTime']);
            $sql->bindParam(':endTime', $_POST['endTime']);
            $sql->bindParam(':coach', $_POST['coach']);
            $sql->bindParam(':room', $_POST['room']);

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            $q = "INSERT INTO `blocks` (`id`, `meeting_id`, `start_time`, `available`) VALUES (NULL, :meetingID, :startTime, '1')";

            $meetingID = $this->conn->lastInsertId();
            $startTime = $_POST['startTime'];

            $t = ((int)$_POST['endTime'] - (int)$_POST['startTime']) * 5;

            for ($x = 0; $x <= $t; $x++) {
                
                $sql = $this->conn->prepare($q);
                $sql->bindParam(':meetingID', $meetingID);
                $sql->bindParam(':startTime', $startTime);
                
                try {
                    $sql->execute();
                }
                catch(PDOException $e)
                {
                    Response::error(['error' => $e->getMessage()],500);
                }

                $time = new DateTime('2011-11-17 ' . $startTime);
                $time->add(new DateInterval('PT' . 12 . 'M'));

                $startTime = $time->format('H:i');
            }

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

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            return true;
        }

        private function checkDuplicate($date, $startTime, $endTime, $coach, $room)
        {
            $q = "
                SELECT * 
                FROM `meetings` 
                WHERE `date` = :date
            ";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':date', $date);

            try {
                $sql->execute();
            }
            catch (PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            if(!$res = $sql->fetchAll(PDO::FETCH_ASSOC))
                return true;

            foreach($res as $meeting)
                if($meeting['room'] === $room)
                    if($meeting['start_time'] === $startTime && $meeting['end_time'] === $endTime)
                        Response::error("There is already a meeting in this room at this moment.", 400);

            return true;
        }
    }

    $meetingController = new MeetingController($db);