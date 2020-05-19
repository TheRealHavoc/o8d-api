<?php
    class UserController
    {
        private $conn;

        /**
         * UserController constructor.
         * @param $db
         */
        public function __construct($db)
        {
            $this->conn = $db->conn;
        }

        /**
         * @return mixed
         */
        public function signin()
        {
            if (
                !isset($_POST['email']) ||
                !isset($_POST['password'])
            ) Response::error("Not enough form data.", 400);

            $params = (object) array();

            $params->email = htmlspecialchars($_POST['email']);
            $params->password = htmlspecialchars($_POST['password']);

            if(!$user = $this->getUserByEmail($params->email))
                Response::error("You have entered the wrong credentials", 400);

            if(!password_verify($params->password, $user['password']))
                Response::error("You have entered the wrong credentials", 400);

            $token = new Token();
            $token = $token->createGeneric();

            $this->updateToken($user['id'], $token);

            $user['token'] = $token;

            unset($user['password']);

            return $user;
        }

        public function signout($id)
        {
            if($this->updateToken($id, NULL))
                return true;
        }

        /**
         * @return bool
         */
        public function createNewUser()
        {
            if (
                !isset($_POST['email']) ||
                !isset($_POST['password']) ||
                !isset($_POST['firstname']) ||
                !isset($_POST['insertion']) ||
                !isset($_POST['lastname']) ||
                !isset($_POST['role'])
            ) Response::error("Not enough form data.", 400);

            $params = (object) array();

            foreach ($_POST as $key => $value)
                $params->$key = htmlspecialchars($value);

            $params->password = password_hash($params->password, PASSWORD_DEFAULT);

            $q = "
                INSERT INTO `users` 
                    (`id`, `firstname`, `insertion`, `lastname`, `password`, `email`, `role`, `token`) 
                VALUES 
                    (NULL, :firstname, :insertion, :lastname, :password, :email, :role, NULL)
                ";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':firstname', $params->firstname);
            $sql->bindParam(':insertion', $params->insertion);
            $sql->bindParam(':lastname', $params->lastname);
            $sql->bindParam(':password', $params->password);
            $sql->bindParam(':email', $params->email);
            $sql->bindParam(':role', $params->role);

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            return true;
        }

        private function updateToken($id, $token)
        {
            $q = "UPDATE `users` SET `token` = :token WHERE `users`.`id` = :id";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':token', $token);
            $sql->bindParam(':id', $id);

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            return true;
        }

        private function getUserByEmail($email)
        {
            $query = "SELECT * FROM `users` WHERE `email` = :email";

            $sql = $this->conn->prepare($query);
            $sql->bindParam(':email', $email);

            try {
                $sql->execute();
            }
            catch(PDOException $e)
            {
                Response::error(['error' => $e->getMessage()],500);
            }

            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }

    $userController = new UserController($db);