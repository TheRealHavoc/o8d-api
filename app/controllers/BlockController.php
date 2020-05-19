<?php
    class BlockController
    {
        private $conn;

        /**
         * BlockController constructor.
         * @param $db
         */
        public function __construct($db)
        {
            $this->conn = $db->conn;
        }

        /**
         * @param $userID
         * @return bool
         */
        public function addUserToBlock($userID)
        {
            // TODO
            // - Return block details

            if (
                !isset($_POST['meetingID']) ||
                !isset($_POST['startTime']) ||
                !isset($_POST['endTime'])
            ) Response::error("Not enough form data.", 400);

            $q = "INSERT INTO `blocks` (`id`, `meeting_id`, `user_id`, `start_time`, `end_time`, `available`) VALUES (NULL, :meetingID, :userID, :startTime, :endTime, '1')";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':meetingID', $_POST['meetingID']);
            $sql->bindParam(':userID', $userID);
            $sql->bindParam(':startTime', $_POST['startTime']);
            $sql->bindParam(':endTime', $_POST['endTime']);

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            return true;
        }

        /**
         * @return bool
         */
        public function setUnavailable()
        {
            // TODO
            // - Return block details

            if (
                !isset($_POST['id'])
            ) Response::error("Not enough form data.", 400);

            $q = "UPDATE `blocks` SET `available` = '0' WHERE `blocks`.`id` = :id";

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

        public function addUsersBulk($meetingID)
        {
            // TODO
            // - Check if user exists

            $qValues = "";
            foreach(json_decode($_POST['users']) as $value) {
                $qValues .= "('{$meetingID}', '{$value}'),";
            }

            $qValues = substr($qValues, 0, -1);

            $q = "INSERT INTO `blocks` (`meeting_id`, `user_id`) VALUES {$qValues}";

            $sql = $this->conn->prepare($q);

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            return true;
        }
    }
    $blockController = new BlockController($db);