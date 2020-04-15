<?php
    class Response
    {
        public static function go($data, $http_response_code = 200)
        {
            http_response_code($http_response_code);

            echo json_encode($data);
        }
    }
?>