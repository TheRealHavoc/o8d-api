<?php
    class MailController
    {
        private $conn;

        /**
         * MailController constructor.
         * @param $db
         */
        public function __construct($db)
        {
            $this->conn = $db->conn;
        }

        public function send($to, $subject, $message)
        {
            mail($to, $subject, $message);
        }
    }
    $mailController = new MailController($db);