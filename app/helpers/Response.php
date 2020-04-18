<?php
    class Response
    {
        /**
         * @param $data
         * @param int $http_response_code
         */
        public static function go($data, $http_response_code = 200)
        {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");

            http_response_code($http_response_code);

            echo json_encode($data);

            die;
        }
    }
?>