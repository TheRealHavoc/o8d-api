<?php
    class Auth
    {
        /**
         * @param $db
         * @param int $requiredRole
         * @return mixed
         */
        public static function authenticateByToken($db, $requiredRole = 0)
        {
            $request = (object) array();

            $request->headers = getallheaders();

            $sql = $db->conn->prepare('SELECT `id`, `token`, `role` FROM `users` WHERE `token` = :token');
            $sql->bindParam(':token', $request->headers['token']);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            if(!$res = $sql->fetch())
                Response::error("You are unauthorized", 401);

            if($requiredRole !== 0)
                if($res['role'] != $requiredRole)
                    Response::error("You are unauthorized", 401);

            return $res;
        }
    }