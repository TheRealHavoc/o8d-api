<?php
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