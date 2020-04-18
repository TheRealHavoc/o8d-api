<?php
//    $url = array_slice(explode("?", $_SERVER['REQUEST_URI']), 0);
//
//    switch($url[0]) {
//        case '':
//            $response = 'pages/index.php';
//            break;
//
//        default:
//            $response = 'pages/error/404.php';
//        break;
//    }
    class Router
    {
        public $page;

        /**
         * @param $route
         * @param $page
         * @return string
         */
        public function url($route, $page)
        {
            $url = array_slice(explode("?", $_SERVER['REQUEST_URI']), 0);

            $params = (isset($url[1]) ? $url[1] : '');

            if($url[0] != $route) {
                return $this->page = 'pages/error/404.php';
            }

            return $this->page = $page;
        }
    }
?>