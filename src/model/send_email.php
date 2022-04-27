<?php
	
	//Uses PHPMailer to send email
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

    require("../../vendor/autoload.php");

	//gmail username and password
	define('GUSER', 'franjotudman16@gmail.com');
	define('GPASS', 'Anubismon123');


	/**
	 * Sends an email
	 *
	 * @$to ->  For whom is email meant to be
	 * @$from -> From whom is the email from
	 * @$from_name -> Name of the person or company who is sending the email
	 * @$subject -> Subject/Title of the email
	 * @$body -> Contents of the email
	 */

	function send_email(string $to, string $from, string $from_name, string $subject, string $body) : bool
	{
		global $error;

		$mail = new PHPMailer(true);
    	$mail->isSMTP();
    	$mail->SMTPAuth = true;
    	$mail->SMTPSecure = 'tls';
    	$mail->SMTPAutoTLS = false;
    	$mail->Host = 'smtp.gmail.com';
    	$mail->Port = 587;
		$mail->isHTML(true);
   
  	  	$mail->Username = GUSER;
    	$mail->Password = GPASS;
		$mail->setFrom($from, $from_name);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AddAddress($to);


		if($mail->send())
		{
            $error = "Message sent!";
			return true;
		}

        $error = "Email error: " . $mail->ErrorInfo . "<br>";
		return false;

 	}

?>
