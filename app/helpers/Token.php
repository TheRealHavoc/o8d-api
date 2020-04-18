<?php
    class Token
    {
        /**
         * @return string
         */
        public function createGeneric()
        {
            return md5(uniqid(rand(), true));
        }

        /**
         * @param $username
         * @return string|string[]
         */
        public function create($username)
        {
            return $this->base64url_encode(hash_hmac(
                    'sha256',
                    time().'.'.$username,
                    APP_KEY,
                    true
            ));
        }

        /**
         * @param $str
         * @return string|string[]
         */
        private function base64url_encode($str) {

            return str_replace(['+','/','='], ['-','_',''], base64_encode($str));

        }
    }
?>
