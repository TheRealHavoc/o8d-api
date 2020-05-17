<?php
    class Auth
    {
        public static function authenticateByToken($db)
        {
            $request = (object) array();

            $request->headers = getallheaders();

            $sql = $db->conn->prepare('SELECT `id`, `token` FROM `users` WHERE `token` = :token');
            $sql->bindParam(':token', $request->headers['token']);

            if(!$sql->execute())
                Response::error("Something went wrong", 500);

            if(!$res = $sql->fetch())
                Response::error("You are unauthorized", 401);

            return $res;
        }
    }