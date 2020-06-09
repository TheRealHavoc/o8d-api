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

            $params = (object)array();

            $params->email = htmlspecialchars($_POST['email']);
            $params->password = htmlspecialchars($_POST['password']);

            if (!$user = $this->getUserByEmail($params->email))
                Response::error("You have entered the wrong credentials", 400);

            if (!password_verify($params->password, $user['password']))
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
            if ($this->updateToken($id, NULL))
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

            $params = (object)array();

            foreach ($_POST as $key => $value)
                $params->$key = htmlspecialchars($value);

            if($this->getUserByEmail($params->email))
                Response::error("User with this e-mail already exists.", 400);

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
            } catch (PDOException $e) {
                Response::error(['error' => $e->getMessage()], 500);
            }

            return true;
        }

        /**
         * @return bool
         */
        public function createNewStudent()
        {
            if (
                !isset($_POST['firstname']) ||
                !isset($_POST['insertion']) ||
                !isset($_POST['lastname']) ||
                !isset($_POST['studentNr']) ||
                !isset($_POST['class']) ||
                !isset($_POST['coach']) ||
                !isset($_POST['parent'])
            ) Response::error("Not enough form data.", 400);

            $params = (object)array();

            foreach ($_POST as $key => $value)
                $params->$key = htmlspecialchars($value);

            $q = "
                INSERT INTO `students` 
                    (`firstname`, `insertion`, `lastname`, `student_nr`, `class`, `coach`, `parent`) 
                VALUES 
                    (:firstname, :insertion, :lastname, :student_nr, :class, :coach, :parent)
            ";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':firstname', $params->firstname);
            $sql->bindParam(':insertion', $params->insertion);
            $sql->bindParam(':lastname', $params->lastname);
            $sql->bindParam(':student_nr', $params->studentNr);
            $sql->bindParam(':class', $params->class);
            $sql->bindParam(':coach', $params->coach);
            $sql->bindParam(':parent', $params->parent);

            try {
                $sql->execute();
            } catch (PDOException $e) {
                Response::error(['error' => $e->getMessage()], 500);
            }

            return true;
        }

        /**
         * @return bool
         */
        public function uploadStudents()
        {    
            if (
                !isset($_POST['firstname']) ||
                !isset($_POST['insertion']) ||
                !isset($_POST['lastname']) ||
                !isset($_POST['studentNr']) ||
                !isset($_POST['class'])
            ) Response::error("Not enough form data.", 400);

            $params = (object)array();

            foreach ($_POST as $key => $value)
                $params->$key = htmlspecialchars($value);

            $q = "
                INSERT INTO `students` 
                    (`firstname`, `insertion`, `lastname`, `student_nr`, `class`) 
                VALUES 
                    (:firstname, :insertion, :lastname, :student_nr, :class)
            ";

            $sql = $this->conn->prepare($q);
            $sql->bindParam(':firstname', $params->firstname);
            $sql->bindParam(':insertion', $params->insertion);
            $sql->bindParam(':lastname', $params->lastname);
            $sql->bindParam(':student_nr', $params->studentNr);
            $sql->bindParam(':class', $params->class);

            try {
                $sql->execute();
            } catch (PDOException $e) {
                Response::error(['error' => $e->getMessage()], 500);
            }

            return true;
        }

        public function indexAllUsers($withRole = null)
        {
            $q = "SELECT * FROM `users`";

            if($withRole !== null)
                $q .= " WHERE `role` = :role";

            $sql = $this->conn->prepare($q);

            if($withRole !== null)
                $sql->bindParam(':role', $withRole);

            try {
                $sql->execute();
            } catch (PDOException $e) {
                Response::error(['error' => $e->getMessage()], 500);
            }

            if(!$res = $sql->fetchAll())
                Response::error("Could not find users.", 404);

            return $res;
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