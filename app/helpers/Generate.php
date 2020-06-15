<?php
    class Generate
    {
        public static function password()
        {
            return substr(md5(uniqid(rand(), true)), 0, 8);
        }
    }
    ?>
