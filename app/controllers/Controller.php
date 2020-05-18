<?php
    class Controller
    {
        private $conn;

        /**
         * Controller constructor.
         * @param $db
         */
        public function __construct($db)
        {
            $this->conn = $db->conn;
        }
    }
    $Controller = new Controller($db);