<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-6.9.1/src/Exception.php';
require 'PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer-6.9.1/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'mail.skyratesipifalls.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@skyratesipifalls.com';
    $mail->Password = 'Secret@123$$';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->setFrom('info@skyratesipifalls.com', 'Test Mail');
    $mail->addAddress('emmymorgan1278@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'If you receive this, SMTP works.';

    $mail->send();
    echo 'Message sent successfully.';
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
