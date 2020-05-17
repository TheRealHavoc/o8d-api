<?php
    class UserController
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

        public function createUser(){
            if (
                !isset($_POST['firstname']) ||
                !isset($_POST['insertion']) ||
                !isset($_POST['lastname']) ||
                !isset($_POST['password']) ||
                !isset($_POST['email']) ||
                !isset($_POST['role'])
            ) Response::error("Not enough form data.", 400);

            $sql = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

            if(!$sql->execute(array($_POST['email'])))
                Response::error("Something went wrong.", 500);

            if($res = $sql->fetch())
                Response::error("Email already registered", 404);

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = $this->conn->prepare("INSERT INTO users (firstname, insertion, lastname, password, email, role) VALUES (?, ?, ?, ?, ?, ?)");

            if(!$sql->execute(array($_POST['firstname'], $_POST['insertion'], $_POST['lastname'],  $password, $_POST['email'], $_POST['role'])))
                Response::error("Something went wrong.", 500);
            
            return true;
        }
    }

    $userController = new UserController($db);