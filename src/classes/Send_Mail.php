<?php

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;
require __DIR__ . '/../../vendor/autoload.php';

//Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

/**
  class for sending out an email
    @to ->  For whom is email meant to be
    @from -> From whom is the email from
    @from_name -> Name of the person or company who is sending the email
    @subject -> Subject/Title of the email
    @body -> Contents of the email
*/

class Send_Mail extends PHPMailer
{
    public $error;

    public static function sendEmail(string $to, string $from, string $from_name, string $subject, string $body) : bool
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->isHTML(true);

        $mail->Username = $_ENV['GUSER'];
        $mail->Password = $_ENV['GPASS'];
        $mail->setFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->addAddress($to);


        if($mail->send()) {
            return true;
        }

        $error = "Email error " . $mail->ErrorInfo . "<br>";
        echo $error;

        return false;
    }
}
