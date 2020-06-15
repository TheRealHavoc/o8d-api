<?php
    class Mail
    {
        public static function newAccount($email, $password)
        {
            $subject = '
                ROC Midden Nederland ouderavond app inlog gegevens.
            ';

            $body = "
                Beste lezer,
                
                U bent uitgenodigd voor de ouderavond app van ROC Midden Nederland. Hieronder staan je inlog gegevens.
                
                {$email}
                {$password}
                
                U kunt inloggen via de onderstaande link:
                
                https://google.com/
                
                Bedankt!
            ";

            mail($email, $subject, $body);
        }
    }
?>
