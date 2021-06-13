<?php
namespace System\Libraries;
/**
 * Email Class
 */

use PHPMailer\PHPMAiler\PHPMailer;
use PHPMailer\PHPMAiler\SMTP;
use PHPMailer\PHPMAiler\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";

class Email
{
    public static function sendEmail($address, $subject, $body)
    {

        global $email;

        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = $email['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $email['username'];
            $mail->Password = $email['password'];
            $mail->SMTPSecure = $email['encryption']; //PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $email['port'];

            //Recipients
            $mail->setFrom($email['from']['address'], $email['from']['name']);
            $mail->addAddress($address);


            //Attachment
            //$mail->addAttachment("");

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            //echo "Message has been sent";


        } catch (Exception $e) {
            //throw $e;
        }
    }
}
