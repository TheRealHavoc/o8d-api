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

            if(substr($route, 0, 1) !== '/') {
                $route = '/' . $route;
            }

            if($url[0] === $route) {
                $this->page = $page;
            }
        }
    }
?>