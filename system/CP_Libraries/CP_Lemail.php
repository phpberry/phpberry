<?php
if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}
    class CP_Lemail {

        public function email( $to,$from,$subject,$message,$cc = NULL) {

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ' .$from. "\r\n";
            if($cc != NULL){
                $headers .= 'CC: ' .$cc. "\r\n";
            }
            $headers .= 'Reply-To: ' .$from. "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
        
           return mail($to, $subject, $message, $headers) ? true : false ;           
        }
    }