<?php
    class Mail
    {
        public static function newAccount($email, $password)
        {
            $appUrl = 'http://500309.student4a7.ao-ica.nl/public_html/inplannen-login.html';

            $subject = '
                ROC Midden Nederland ouderavond app inlog gegevens.
            ';

            $body = "
                Beste lezer,
                
                U bent uitgenodigd voor de ouderavond app van ROC Midden Nederland. Hieronder staan je inlog gegevens.
                
                {$email}
                {$password}
                
                U kunt inloggen via de onderstaande link:
                
                {$appUrl}
                
                Bedankt!
            ";

            mail($email, $subject, $body);
        }
    }
?>
